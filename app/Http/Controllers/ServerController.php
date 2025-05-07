<?php

namespace App\Http\Controllers;

use App\Models\Server;
use App\Models\Client;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function index()
    {
        $servers = Server::with('client')->get();
        return view('servers.index_servers', compact('servers'));
    }

    public function create()
    {
        $clients = Client::all();
        return view('servers.create_servers', compact('clients'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id'
        ]);

        // Verifica se já existe um servidor com o mesmo nome para o mesmo cliente
        $exists = Server::where('name', $validated['name'])
                       ->where('client_id', $validated['client_id'])
                       ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Já existe um servidor com este nome para este cliente.'
            ], 422);
        }

        $server = Server::create($validated);
        return response()->json($server);
    }

    public function show(Server $server)
    {
        $server->load('client');
        return view('servers.show_servers', compact('server'));
    }

    public function edit(Server $server)
    {
        $clients = Client::all();
        return view('servers.edit_servers', compact('server', 'clients'));
    }

    public function update(Request $request, Server $server)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'client_id' => 'required|exists:clients,id'
        ]);

        // Verifica duplicatas excluindo o registro atual
        $exists = Server::where('name', $validated['name'])
                       ->where('client_id', $validated['client_id'])
                       ->where('id', '!=', $server->id)
                       ->exists();

        if ($exists) {
            return response()->json([
                'error' => 'Já existe um servidor com este nome para este cliente.'
            ], 422);
        }

        $server->update($validated);
        return response()->json($server);
    }

    public function destroy(Server $server)
    {
        $server->delete();
        return response()->json(['message' => 'Servidor excluído com sucesso']);
    }

    public function search(Request $request)
    {
        $query = $request->get('query');  // Recebe o parâmetro 'query' da URL
        
        $servers = Server::query()
            ->when($query, function($q) use ($query) {
                return $q->where('name', 'like', "%{$query}%")
                        ->orWhereHas('client', function($q) use ($query) {
                            $q->where('name', 'like', "%{$query}%");
                        });
            })
            ->with('client')
            ->get();
    
        if ($servers->isEmpty()) {
            return response()->json([
                'message' => 'Nenhum servidor encontrado',
                'data' => []
            ]);
        }
    
        return response()->json([
            'message' => 'Servidores encontrados',
            'data' => $servers->map(function($server) {
                return [
                    'name' => $server->name,
                    'client_name' => $server->client->name
                ];
            })
        ]);
    }

    public function autocomplete(Request $request)
    {
        $search = $request->get('search');
        $clientId = $request->get('client_id');

        $servers = Server::where('name', 'LIKE', "%{$search}%")
            ->when($clientId, function($query) use ($clientId) {
                return $query->where('client_id', $clientId);
            })
            ->limit(10)
            ->get()
            ->map(function($server) {
                return [
                    'id' => $server->id,
                    'value' => $server->name,
                    'label' => $server->name
                ];
            });
        
        return response()->json($servers);
    }
}