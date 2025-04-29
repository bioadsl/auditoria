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

class CallController extends Controller
{
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

    public function update(Request $request, Call $call)
    {
        $validated = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'agent_id' => 'required|exists:agents,id',
            'server_id' => 'nullable|exists:servers,id',
            'ticket_number' => 'nullable|string|max:255',
            'problem_description_id' => 'nullable|exists:problem_descriptions,id',
            'action_type_id' => 'required|exists:action_types,id',
            'final_status_id' => 'required|exists:final_statuses,id',
            'call_result_id' => 'required|exists:call_results,id',
            'observation' => 'nullable|string',
            'remote_access' => 'boolean',
        ]);

        // Handle boolean field
        $validated['remote_access'] = $request->has('remote_access');

        try {
            $call->update($validated);
            return redirect()->route('calls.index')->with('success', 'Chamado atualizado com sucesso.');
        } catch (\Exception $e) {
            \Log::error('Error updating call: ' . $e->getMessage());
            return back()->withInput()->with('error', 'Erro ao atualizar o chamado.');
        }
    }

    public function destroy(Call $call)
    {
        $call->delete();

        return redirect()->route('calls.index')
            ->with('success', 'Chamado excluído com sucesso.');
    }
}