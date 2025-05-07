<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        try {
            $calls = Call::with([
                'agent', 
                'client', 
                'actionType', 
                'finalStatus', 
                'callResult'
            ])
            ->orderByRaw('CAST(ticket_number AS UNSIGNED) ASC')
            ->get();

            return response()->json([
                'success' => true,
                'data' => $calls
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erro ao buscar os chamados',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}