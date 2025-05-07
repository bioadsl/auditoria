<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;

class AgentsController extends Controller
{
    public function index()
    {
        $agents = Agent::all();
        return view('agents.index_agent', compact('agents'));
    }

    public function create()
    {
        return view('agents.create_agent');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:agents',
            'name' => 'required|string|max:255',
            'active' => 'boolean'
        ]);

        Agent::create($validated);
        return redirect()->route('agents.index')->with('success', 'Agente criado com sucesso!');
    }

    public function show(Agent $agent)
    {
        return view('agents.show_agent', compact('agent'));
    }

    public function edit(Agent $agent)
    {
        return view('agents.edit_agent', compact('agent'));
    }

    public function update(Request $request, Agent $agent)
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:agents,code,' . $agent->id,
            'name' => 'required|string|max:255',
            'active' => 'boolean'
        ]);

        $agent->update($validated);
        return redirect()->route('agents.index')->with('success', 'Agente atualizado com sucesso!');
    }

    public function destroy(Agent $agent)
    {
        $agent->delete();
        return redirect()->route('agents.index')->with('success', 'Agente excluído com sucesso!');
    }
}