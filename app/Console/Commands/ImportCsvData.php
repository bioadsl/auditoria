<?php
namespace App\Console\Commands;

use App\Models\Call;
use App\Models\Agent;
use App\Models\Client;
use App\Models\ActionType;
use App\Models\FinalStatus;
use App\Models\CallResult;
use App\Models\ProblemDescription;
use App\Models\Server;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ImportCsvData extends Command
{
    protected $signature = 'import:csv {file? : Caminho para o arquivo CSV} {--delimiter=, : Delimitador do CSV}';
    protected $description = 'Importar dados do arquivo CSV';

    public function handle()
    {
        $this->info('Iniciando importação do CSV...');
    
        $filePath = $this->argument('file') ?? base_path('files/Auditoria.csv');
        // Update the default path to match exact casing
        $filePath = str_replace('files/Auditoria.csv', 'files\\Auditoria.csv', $filePath);
        
        $delimiter = $this->option('delimiter');
        
        if (!file_exists($filePath)) {
            $this->error("Arquivo não existe: {$filePath}");
            return 1;
        }
        
        $content = file_get_contents($filePath);
        
        $bom = pack('H*', 'EFBBBF');
        if (strncmp($content, $bom, 3) === 0) {
            $content = substr($content, 3);
            $this->info("BOM detected and removed from file.");
        }
        
        $tempFile = tempnam(sys_get_temp_dir(), 'csv_import');
        file_put_contents($tempFile, $content);
        
        $file = fopen($tempFile, 'r');
    
        if (!$file) {
            $this->error("Não foi possível abrir o arquivo CSV!");
            return 1;
        }
        
        // Lê e limpa os cabeçalhos do CSV
        $headers = array_map(function($header) {
            return trim(str_replace(' ', '', $header));
        }, fgetcsv($file, 0, $delimiter));
        
        // Then check if headers were read successfully
        if ($headers === false) {
            $this->error("Não foi possível ler o cabeçalho do arquivo CSV!");
            fclose($file);
            unlink($tempFile);
            return 1;
        }
    
        $this->info("Cabeçalhos encontrados: " . implode(", ", $headers));
        
        $agents = [];
        $clients = [];
        $servers = [];
        $actionTypes = [];
        $finalStatuses = [];
        $callResults = [];
        $problemDescriptions = [];
        $count = 0;
        $errors = 0;
        
        DB::beginTransaction();
        
        try {
            $rowNumber = 1;
            
            while (($row = fgetcsv($file, 0, $delimiter)) !== false) {
                $rowNumber++;
                
                // Verificação mais rigorosa dos dados
                if (count($row) !== 14) {
                    $this->warn("Linha {$rowNumber}: Número incorreto de colunas: " . count($row));
                    $errors++;
                    continue;
                }
                
                try {
                    $ticketNumber = trim($row[0] ?? '');
                    $agentName = trim($row[1] ?? '');
                    $clientName = trim($row[2] ?? '');
                    $dateStr = trim($row[3] ?? '');
                    $serverName = trim($row[4] ?? '');
                    
                    // Validação mais rigorosa dos campos obrigatórios
                    if (empty($agentName) || empty($clientName)) {
                        $this->warn("Linha {$rowNumber}: Campos obrigatórios vazios (agente ou cliente)");
                        $errors++;
                        continue;
                    }

                    // Criar cliente antes de qualquer outra operação
                    if (!isset($clients[$clientName])) {
                        $client = Client::firstOrCreate(['name' => $clientName]);
                        $clients[$clientName] = $client->id;
                    }

                    $callNumber = trim($row[5] ?? '');
                    $problemDesc = trim($row[6] ?? '');
                    $actionTypeName = trim($row[7] ?? 'Sem Ação');
                    $finalStatusName = trim($row[8] ?? 'Pendente');
                    $callResultName = trim($row[9] ?? 'Pendente');
                    $observation = trim($row[10] ?? '');
                    $waitTime = intval(trim($row[11] ?? '0'));
                    $remoteAccess = (strtolower(trim($row[12] ?? 'Não')) === 'sim');
                    
                    if (empty($agentName) || empty($clientName)) {
                        $this->warn("Linha {$rowNumber}: Pulando linha com nome de agente ou cliente vazio");
                        continue;
                    }
                    
                    if (!isset($agents[$agentName])) {
                        $agent = Agent::firstOrCreate(
                            ['name' => $agentName],
                            ['code' => strtoupper(Str::substr(Str::slug($agentName), 0, 3) . rand(100, 999))]
                        );
                        $agents[$agentName] = $agent->id;
                    }
                    
                    if (!isset($clients[$clientName])) {
                        $client = Client::firstOrCreate(['name' => $clientName]);
                        $clients[$clientName] = $client->id;
                    }
                    
                    $serverId = null;
                    if (!empty($serverName)) {
                        if (!isset($servers[$serverName])) {
                            $server = Server::firstOrCreate(
                                [
                                    'name' => $serverName,
                                    'client_id' => $clients[$clientName] // Add client_id here
                                ]
                            );
                            $servers[$serverName] = $server->id;
                        }
                        $serverId = $servers[$serverName];
                    }
                    
                    if (!isset($actionTypes[$actionTypeName])) {
                        $actionType = ActionType::firstOrCreate(['name' => $actionTypeName]);
                        $actionTypes[$actionTypeName] = $actionType->id;
                    }
                    
                    if (!isset($finalStatuses[$finalStatusName])) {
                        $finalStatus = FinalStatus::firstOrCreate(['name' => $finalStatusName]);
                        $finalStatuses[$finalStatusName] = $finalStatus->id;
                    }
                    
                    if (!isset($callResults[$callResultName])) {
                        $callResult = CallResult::firstOrCreate(['name' => $callResultName]);
                        $callResults[$callResultName] = $callResult->id;
                    }
                    
                    $problemDescriptionId = null;
                    if (!empty($problemDesc)) {
                        if (!isset($problemDescriptions[$problemDesc])) {
                            $problemDescription = ProblemDescription::firstOrCreate(['description' => $problemDesc]);
                            $problemDescriptions[$problemDesc] = $problemDescription->id;
                        }
                        $problemDescriptionId = $problemDescriptions[$problemDesc];
                    }
                    
                    $callDate = null;
                    if (!empty($dateStr)) {
                        try {
                            if (strpos($dateStr, '/') !== false) {
                                if (strpos($dateStr, ':') !== false) {
                                    $callDate = Carbon::createFromFormat('d/m/Y H:i:s', $dateStr);
                                } else {
                                    $callDate = Carbon::createFromFormat('d/m/Y', $dateStr);
                                }
                            } else {
                                $callDate = Carbon::parse($dateStr);
                            }
                            
                            if (!$callDate->isValid()) {
                                throw new \Exception("Formato de data inválido");
                            }
                        } catch (\Exception $e) {
                            $this->warn("Linha {$rowNumber}: Formato de data inválido: {$dateStr}. Usando data atual.");
                            $callDate = Carbon::now();
                        }
                    } else {
                        $callDate = Carbon::now();
                    }
                    
                    $callData = [
                        'agent_id' => $agents[$agentName],
                        'client_id' => $clients[$clientName],
                        'server_id' => $serverId,
                        'action_type_id' => $actionTypes[$actionTypeName],
                        'final_status_id' => $finalStatuses[$finalStatusName],
                        'call_result_id' => $callResults[$callResultName],
                        'problem_description_id' => $problemDescriptionId,
                        'call_date' => $callDate,
                        'observation' => $observation,
                        'wait_time' => $waitTime,
                        'remote_access' => $remoteAccess,
                        'call_number' => $callNumber
                    ];
                    
                    if (!empty($ticketNumber)) {
                        Call::updateOrCreate(
                            ['ticket_number' => $ticketNumber],
                            $callData
                        );
                    } else {
                        Call::create($callData);
                    }
                    
                    $count++;
                    if ($count % 10 == 0) {
                        $this->info("Processados {$count} registros...");
                    }
                } catch (\Exception $e) {
                    $this->error("Linha {$rowNumber}: Erro ao processar linha: " . implode(",", $row));
                    $this->error($e->getMessage());
                    $errors++;
                    continue;
                }
            }
            
            DB::commit();
            
            fclose($file);
            unlink($tempFile);
            
            $this->info("Importação concluída!");
            $this->info("Total de registros processados com sucesso: {$count}");
            if ($errors > 0) {
                $this->warn("Total de erros: {$errors}");
            }
            
            $this->info("\nEstatísticas:");
            $this->info("Agentes: " . count($agents));
            $this->info("Clientes: " . count($clients));
            $this->info("Servidores: " . count($servers));
            $this->info("Tipos de Ação: " . count($actionTypes));
            $this->info("Status Finais: " . count($finalStatuses));
            $this->info("Resultados: " . count($callResults));
            $this->info("Descrições de Problemas: " . count($problemDescriptions));
            
            return 0;
        } catch (\Exception $e) {
            DB::rollBack();
            $this->error("Erro fatal durante a importação: " . $e->getMessage());
            if (file_exists($tempFile)) {
                unlink($tempFile);
            }
            return 1;
        }
    }
}
