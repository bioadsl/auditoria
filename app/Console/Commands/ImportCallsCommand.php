<?php

namespace App\Console\Commands;

use App\Models\Agent;
use App\Models\Call;
use App\Models\Client;
use App\Models\Server;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ImportCallsCommand extends Command
{
    protected $signature = 'calls:import {file : Caminho do arquivo CSV}';
    protected $description = 'Importa chamados de um arquivo CSV';

    public function handle()
    {
        $file = $this->argument('file');
        
        if (!file_exists($file)) {
            $this->error("Arquivo não encontrado: {$file}");
            return 1;
        }

        $this->info('Iniciando importação...');
        
        DB::beginTransaction();
        try {
            $handle = fopen($file, 'r');
            
            // Pula o cabeçalho
            fgetcsv($handle);
            
            $count = 0;
            while (($data = fgetcsv($handle)) !== false) {
                $this->processRow($data);
                $count++;
                
                if ($count % 100 === 0) {
                    $this->info("Processados {$count} registros...");
                }
            }
            
            fclose($handle);
            DB::commit();
            
            $this->info("Importação concluída! {$count} registros processados.");
            return 0;
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Erro na importação: ' . $e->getMessage());
            $this->error('Erro na importação: ' . $e->getMessage());
            return 1;
        }
    }

    private function processRow(array $data)
    {
        // Mapeia as colunas do CSV
        [
            $nrAtend,
            $agente,
            $cliente,
            $dataHora,
            $nome,
            $chamado,
            $descricao,
            $acao,
            $situacao,
            $resultado,
            $observacao,
            $espera,
            $acessoRemoto,
            $mes
        ] = $data;

        // Encontra ou cria o cliente
        $client = Client::firstOrCreate(['name' => $cliente]);

        // Encontra o agente pelo nome
        $agent = Agent::where('name', 'LIKE', "%{$agente}%")->first();
        if (!$agent) {
            Log::warning("Agente não encontrado: {$agente}");
            return;
        }

        // Encontra ou cria o servidor
        $server = null;
        if (!empty($nome)) {
            $server = Server::firstOrCreate(
                ['name' => $nome],
                ['client_id' => $client->id]
            );
        }

        // Cria o chamado
        Call::create([
            'agent_id' => $agent->id,
            'client_id' => $client->id,
            'server_id' => $server?->id,
            'ticket_number' => $chamado,
            'problem_description' => $descricao,
            'action_type' => $acao,
            'final_status' => $situacao,
            'call_result' => $resultado,
            'observation' => $observacao,
            'wait_time' => (int) $espera,
            'remote_access' => $acessoRemoto === 'Sim',
            'call_date' => \DateTime::createFromFormat('d/m/Y H:i:s', $dataHora)
        ]);
    }
} 