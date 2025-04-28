<?php

namespace App\Http\Controllers;

use App\Models\Call;
use App\Models\Server;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AutocompleteController extends Controller
{
    /**
     * Retorna sugestões de servidores para autocomplete
     */
    public function servers(Request $request): JsonResponse
    {
        $search = $request->get('term');
        $servers = Server::where('name', 'LIKE', "%{$search}%")
            ->orWhere('ip', 'LIKE', "%{$search}%")
            ->limit(10)
            ->get(['id', 'name', 'ip']);
            
        return response()->json($servers);
    }
    
    /**
     * Retorna sugestões de descrições de problemas para autocomplete
     */
    public function problemDescriptions(Request $request): JsonResponse
    {
        $search = $request->get('term');
        $descriptions = Call::where('problem_description', 'LIKE', "%{$search}%")
            ->distinct()
            ->limit(10)
            ->pluck('problem_description');
            
        return response()->json($descriptions);
    }
}
