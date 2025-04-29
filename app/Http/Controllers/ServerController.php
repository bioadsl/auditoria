<?php

namespace App\Http\Controllers;

use App\Models\Server;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function autocomplete(Request $request)
    {
        $search = $request->get('term');
        $results = Server::where('name', 'LIKE', "%{$search}%")
            ->select('id', 'name')
            ->orderBy('name')
            ->take(10)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'label' => $item->name,
                    'value' => $item->name
                ];
            });

        return response()->json($results);
    }

    public function store(Request $request)
    {
        $server = Server::create([
            'name' => $request->name
        ]);
        
        return response()->json($server);
    }
}