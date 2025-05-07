<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Call;
use App\Models\Client;
use App\Models\Agent;
use App\Models\ActionType;
use App\Models\FinalStatus;
use App\Models\CallResult;
use App\Models\Server;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *     version="1.0.0",
 *     title="API de Auditoria",
 *     description="API para gerenciamento de chamados de auditoria",
 *     @OA\Contact(
 *         email="contato@auditoria.com"
 *     )
 * )
 */
class CallController extends BaseController
{
    /**
     * Constructor with middleware configuration
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * @OA\Get(
     *     path="/calls",
     *     tags={"Chamados"},
     *     summary="Lista todos os chamados",
     *     description="Retorna uma lista de todos os chamados ordenados por data de criação",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de chamados recuperada com sucesso"
     *     )
     * )
     */
    public function index()
    {
        $calls = Call::with(['client', 'agent', 'actionType', 'finalStatus', 'callResult', 'server'])
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('calls.index_calls', compact('calls'));
    }

    /**
     * @OA\Get(
     *     path="/calls/create",
     *     tags={"Chamados"},
     *     summary="Exibe formulário de criação",
     *     description="Retorna a view com o formulário para criar um novo chamado",
     *     @OA\Response(
     *         response=200,
     *         description="Formulário exibido com sucesso"
     *     )
     * )
     */
    public function create()
    {
        $clients = Client::all();
        $agents = Agent::all();
        $actionTypes = ActionType::all();
        $finalStatuses = FinalStatus::all();
        $callResults = CallResult::all();
        
        return view('calls.create_calls', compact(
            'clients',
            'agents',
            'actionTypes',
            'finalStatuses',
            'callResults'
        ));
    }

    /**
     * @OA\Post(
     *     path="/calls",
     *     tags={"Chamados"},
     *     summary="Cria um novo chamado",
     *     description="Cria um novo registro de chamado no sistema",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"client_id","agent_id","server_name","action_type_id","final_status_id","call_result_id","call_date","problem_description"},
     *             @OA\Property(property="client_id", type="integer", description="ID do cliente"),
     *             @OA\Property(property="agent_id", type="integer", description="ID do agente"),
     *             @OA\Property(property="server_name", type="string", description="Nome do servidor"),
     *             @OA\Property(property="ticket_number", type="string", nullable=true, description="Número do ticket"),
     *             @OA\Property(property="action_type_id", type="integer", description="ID do tipo de ação"),
     *             @OA\Property(property="final_status_id", type="integer", description="ID do status final"),
     *             @OA\Property(property="call_result_id", type="integer", description="ID do resultado do chamado"),
     *             @OA\Property(property="call_date", type="string", format="date-time", description="Data do chamado (d/m/Y H:i:s)"),
     *             @OA\Property(property="remote_access", type="boolean", nullable=true, description="Indica se houve acesso remoto"),
     *             @OA\Property(property="problem_description", type="string", maxLength=1000, description="Descrição do problema"),
     *             @OA\Property(property="observation", type="string", nullable=true, maxLength=1000, description="Observações adicionais")
     *         )
     *     ),
     *     @OA\Response(
     *         response=302,
     *         description="Chamado criado com sucesso, redirecionando"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erro de validação",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Dados inválidos"),
     *             @OA\Property(property="errors", type="object")
     *         )
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            Log::info('Iniciando criação de chamado', $request->all());

            $validated = $request->validate([
                'client_id' => 'required|exists:clients,id',
                'agent_id' => 'required|exists:agents,id',
                'server_name' => 'required|string',
                'ticket_number' => 'nullable|string',
                'action_type_id' => 'required|exists:action_types,id',
                'final_status_id' => 'required|exists:final_statuses,id',
                'call_result_id' => 'required|exists:call_results,id',
                'call_date' => 'required',
                'remote_access' => 'nullable|boolean',
                'problem_description' => 'required|string|max:1000',
                'observation' => 'nullable|string|max:1000'
            ]);

            Log::info('Dados validados', $validated);

            // First find or create the server
            $server = Server::firstOrCreate(
                ['name' => $validated['server_name']],
                ['description' => 'Servidor criado automaticamente']
            );

            try {
                $callDate = Carbon::createFromFormat('d/m/Y H:i:s', $validated['call_date']);
            } catch (\Exception $e) {
                return back()
                    ->withInput()
                    ->withErrors(['call_date' => 'Formato de data inválido. Use dd/mm/aaaa hh:mm:ss']);
            }

            $callData = [
                'client_id' => (int)$validated['client_id'],
                'agent_id' => (int)$validated['agent_id'],
                'server_id' => $server->id,
                'ticket_number' => $validated['ticket_number'],
                'action_type_id' => (int)$validated['action_type_id'],
                'final_status_id' => (int)$validated['final_status_id'],
                'call_result_id' => (int)$validated['call_result_id'],
                'call_date' => $callDate,
                'remote_access' => (bool)$request->input('remote_access', false),
                'problem_description' => $validated['problem_description'],
                'observation' => $validated['observation'] ?? null
            ];

            Log::info('Tentando criar chamado com os dados:', $callData);

            DB::beginTransaction();
            
            try {
                $call = new Call();
                $call->fill($callData);
                $saved = $call->save();
                
                if (!$saved) {
                    throw new \Exception('Falha ao criar o registro do chamado');
                }

                DB::commit();
                Log::info('Chamado criado com sucesso', ['call_id' => $call->id]);

                return response()
                    ->json([
                        'message' => 'Chamado criado com sucesso',
                        'data' => $call
                    ], 201)
                    ->header('Location', route('calls.show', $call->id));

            } catch (\Exception $e) {
                DB::rollBack();
                Log::error('Erro na transação', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString(),
                    'data' => $callData
                ]);
                throw $e;
            }

        } catch (\Exception $e) {
            Log::error('Erro ao salvar chamado', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return back()
                ->withInput()
                ->withErrors(['error' => 'Erro ao salvar o chamado: ' . $e->getMessage()]);
        }
    }
}