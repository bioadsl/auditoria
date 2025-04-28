<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AgentController extends Controller
{
    public function index(): JsonResponse
    {
        $agents = Agent::with('calls')->get();
        return response()->json($agents);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:agents',
            'name' => 'required|string|max:255',
            'active' => 'boolean'
        ]);

        $agent = Agent::create($validated);
        return response()->json($agent, 201);
    }

    public function show(Agent $agent): JsonResponse
    {
        $agent->load('calls');
        return response()->json($agent);
    }

    public function update(Request $request, Agent $agent): JsonResponse
    {
        $validated = $request->validate([
            'code' => 'required|string|max:255|unique:agents,code,' . $agent->id,
            'name' => 'required|string|max:255',
            'active' => 'boolean'
        ]);

        $agent->update($validated);
        return response()->json($agent);
    }

    public function destroy(Agent $agent): JsonResponse
    {
        $agent->delete();
        return response()->json(null, 204);
    }
} 