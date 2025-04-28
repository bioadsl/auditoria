<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ServerController extends Controller
{
    public function index(): JsonResponse
    {
        $servers = Server::with(['client', 'calls'])->get();
        return response()->json($servers);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'client_id' => 'required|exists:clients,id'
        ]);

        $server = Server::create($validated);
        return response()->json($server, 201);
    }

    public function show(Server $server): JsonResponse
    {
        $server->load(['client', 'calls']);
        return response()->json($server);
    }

    public function update(Request $request, Server $server): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'department' => 'nullable|string|max:255',
            'client_id' => 'required|exists:clients,id'
        ]);

        $server->update($validated);
        return response()->json($server);
    }

    public function destroy(Server $server): JsonResponse
    {
        $server->delete();
        return response()->json(null, 204);
    }
} 