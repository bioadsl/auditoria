<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Call;
use Illuminate\Http\Request;

class CallController extends Controller
{
    public function index()
    {
        $calls = Call::with(['agent', 'client', 'server', 'problemDescription', 'actionType', 'finalStatus', 'callResult'])
            ->orderByRaw('CAST(ticket_number AS UNSIGNED) ASC')
            ->get();

        return response()->json($calls);
    }
}