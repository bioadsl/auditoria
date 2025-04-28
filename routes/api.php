<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\CallController;
use App\Http\Controllers\ReportController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::get('/ping', function () {
    return response()->json(['status' => 'ok']);
});

// Rotas para Clientes (Órgãos)
Route::apiResource('clients', ClientController::class);

// Rotas para Agentes
Route::apiResource('agents', AgentController::class);

// Rotas para Servidores
Route::apiResource('servers', ServerController::class);

// Rotas para Chamados
Route::apiResource('calls', CallController::class);

// Rotas para Relatórios
Route::prefix('reports')->group(function () {
    Route::get('/calls', [ReportController::class, 'calls']);
    Route::get('/actions', [ReportController::class, 'actions']);
    Route::get('/status', [ReportController::class, 'status']);
    Route::get('/remote-access', [ReportController::class, 'remoteAccess']);
    Route::get('/monthly', [ReportController::class, 'monthly']);
    Route::get('/by-agent', [ReportController::class, 'byAgent']);
    Route::get('/by-user', [ReportController::class, 'byUser']);
    Route::get('/by-time', [ReportController::class, 'byTime']);
    Route::get('/long-wait', [ReportController::class, 'longWait']);
    Route::get('/quality-metrics', [ReportController::class, 'qualityMetrics']);
}); 