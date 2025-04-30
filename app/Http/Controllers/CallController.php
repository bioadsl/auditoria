<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Client;
use App\Models\Agent;
use App\Models\Server;
use App\Models\ActionType;
use App\Models\FinalStatus;
use App\Models\CallResult;
use App\Models\ProblemDescription;
use Illuminate\Http\Request;

/**
 * @OA\Info(
 *     title="Auditoria API",
 *     version="1.0.0"
 * )
 * 
 * @OA\PathItem(
 *     path="/calls"
 * )
 */
class CallController extends Controller
{
    /**
     * @OA\Get(
     *     path="/calls",
     *     summary="List all calls",
     *     @OA\Response(
     *         response=200,
     *         description="Success"
     *     )
     * )
     */
    public function index()
    {
        $perPage = request('per_page', 200); // Default to 200, but allow URL parameter override
        
        $calls = Call::with(['agent', 'client', 'server', 'problemDescription', 'actionType', 'finalStatus', 'callResult'])
            ->orderByRaw('CAST(ticket_number AS UNSIGNED) ASC')
            ->paginate($perPage);

        return view('calls.index', compact('calls'));
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $agents = Agent::orderBy('name')->get();
        $servers = Server::orderBy('name')->get();
        $actionTypes = ActionType::orderBy('name')->get();
        $finalStatuses = FinalStatus::orderBy('name')->get();
        $callResults = CallResult::orderBy('name')->get();

        return view('calls.create', compact(
            'clients',
            'agents',
            'servers',
            'actionTypes',
            'finalStatuses',
            'callResults'
        ));
    }

    /**
     * @OA\Post(
     *     path="/calls",
     *     tags={"Calls"},
     *     summary="Create a new call",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"client_id","agent_id","action_type_id","final_status_id","call_result_id"},
     *             @OA\Property(property="client_id", type="integer"),
     *             @OA\Property(property="agent_id", type="integer"),
     *             @OA\Property(property="server_id", type="integer", nullable=true),
     *             @OA\Property(property="ticket_number", type="string", nullable=true),
     *             @OA\Property(property="problem_description_id", type="integer", nullable=true),
     *             @OA\Property(property="action_type_id", type="integer"),
     *             @OA\Property(property="final_status_id", type="integer"),
     *             @OA\Property(property="call_result_id", type="integer"),
     *             @OA\Property(property="remote_access", type="boolean"),
     *             @OA\Property(property="observation", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(response=201, description="Call created successfully"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'agent_id' => 'required|exists:agents,id',
            'server_id' => 'nullable|exists:servers,id',
            'ticket_number' => 'nullable|string|max:255',
            'problem_description' => 'required|string',
            'action_type_id' => 'required|exists:action_types,id',
            'final_status_id' => 'required|exists:final_statuses,id',
            'call_result_id' => 'required|exists:call_results,id',
            'observation' => 'nullable|string',
            'wait_time' => 'required|integer|min:0',
            'remote_access' => 'required|boolean',
            'call_date' => 'required|date',
        ]);

        Call::create($validated);

        return redirect()->route('calls.index')
            ->with('success', 'Chamado criado com sucesso.');
    }

    public function show(Call $call)
    {
        $call->load(['client', 'agent', 'server', 'actionType', 'finalStatus', 'callResult']);
        return view('calls.show', compact('call'));
    }

    public function edit(Call $call)
    {
        $clients = Client::orderBy('name')->get();
        $agents = Agent::orderBy('name')->get();
        $servers = Server::orderBy('name')->get();
        $actionTypes = ActionType::orderBy('name')->get();
        $finalStatuses = FinalStatus::orderBy('name')->get();
        $callResults = CallResult::orderBy('name')->get();
        $problemDescriptions = ProblemDescription::orderBy('description')->get();

        return view('calls.edit', compact(
            'call',
            'clients',
            'agents',
            'servers',
            'actionTypes',
            'finalStatuses',
            'callResults',
            'problemDescriptions'
        ));
    }

    /**
     * @OA\Put(
     *     path="/calls/{id}",
     *     tags={"Calls"},
     *     summary="Update an existing call",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"client_id","agent_id","action_type_id","final_status_id","call_result_id"},
     *             @OA\Property(property="client_id", type="integer"),
     *             @OA\Property(property="agent_id", type="integer"),
     *             @OA\Property(property="server_id", type="integer", nullable=true),
     *             @OA\Property(property="ticket_number", type="string", nullable=true),
     *             @OA\Property(property="problem_description_id", type="integer", nullable=true),
     *             @OA\Property(property="action_type_id", type="integer"),
     *             @OA\Property(property="final_status_id", type="integer"),
     *             @OA\Property(property="call_result_id", type="integer"),
     *             @OA\Property(property="remote_access", type="boolean"),
     *             @OA\Property(property="observation", type="string", nullable=true)
     *         )
     *     ),
     *     @OA\Response(response=200, description="Call updated successfully"),
     *     @OA\Response(response=404, description="Call not found"),
     *     @OA\Response(response=422, description="Validation error")
     * )
     */
    public function update(Request $request, Call $call)
    {
        try {
            \Log::info('Update Call Request:', $request->all()); // Debug log

            $validated = $request->validate([
                'client_id' => 'required',
                'agent_id' => 'required',
                'server_id' => 'nullable',
                'ticket_number' => 'nullable',
                'action_type_id' => 'required',
                'final_status_id' => 'required',
                'call_result_id' => 'required',
                'problem_description_id' => 'nullable',
                'remote_access' => 'nullable',
                'observation' => 'nullable'
            ]);

            // Convert empty strings to null
            $validated['server_id'] = $request->server_id ?: null;
            $validated['problem_description_id'] = $request->problem_description_id ?: null;
            
            \Log::info('Validated Data:', $validated); // Debug log
            
            $call->update($validated);
            
            \Log::info('Call Updated:', $call->toArray()); // Debug log

            return redirect()->route('calls.index')
                ->with('success', 'Chamado atualizado com sucesso.');
                
        } catch (\Exception $e) {
            \Log::error('Call Update Error: ' . $e->getMessage());
            return back()->with('error', 'Erro ao atualizar o chamado.');
        }
    }

    public function destroy(Call $call)
    {
        $call->delete();

        return redirect()->route('calls.index')
            ->with('success', 'Chamado excluído com sucesso.');
    }
}