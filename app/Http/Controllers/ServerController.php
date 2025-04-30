<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->get('search'); // Changed from 'term' to 'search'
        $servers = Server::where('name', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get()
            ->map(function($server) {
                return [
                    'id' => $server->id,
                    'value' => $server->name, // Added value for autocomplete
                    'label' => $server->name
                ];
            });
        
        return response()->json($servers);
    }

    public function store(Request $request)
    {
        $server = Server::create([
            'name' => $request->name
        ]);
        
        return response()->json($server);
    }
}