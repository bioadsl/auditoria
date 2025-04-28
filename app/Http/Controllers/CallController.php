<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Client;
use App\Models\Agent;
use App\Models\Server;
use App\Models\ActionType;
use App\Models\FinalStatus;
use App\Models\CallResult;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index(Request $request)
    {
        $query = Call::with(['client', 'agent', 'server', 'actionType', 'finalStatus', 'callResult']);

        if ($request->client_id) {
            $query->where('client_id', $request->client_id);
        }

        if ($request->agent_id) {
            $query->where('agent_id', $request->agent_id);
        }

        if ($request->start_date) {
            $query->whereDate('call_date', '>=', $request->start_date);
        }

        if ($request->end_date) {
            $query->whereDate('call_date', '<=', $request->end_date);
        }

        $calls = $query->latest('call_date')->paginate(15);
        $clients = Client::orderBy('name')->get();
        $agents = Agent::orderBy('name')->get();

        return view('calls.index', compact('calls', 'clients', 'agents'));
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

        return view('calls.edit', compact(
            'call',
            'clients',
            'agents',
            'servers',
            'actionTypes',
            'finalStatuses',
            'callResults'
        ));
    }

    public function update(Request $request, Call $call)
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

        $call->update($validated);

        return redirect()->route('calls.index')
            ->with('success', 'Chamado atualizado com sucesso.');
    }

    public function destroy(Call $call)
    {
        $call->delete();

        return redirect()->route('calls.index')
            ->with('success', 'Chamado excluído com sucesso.');
    }
}