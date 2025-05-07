<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Api\CallController as ApiCallController;

Route::get('/ping', function () {
    return response()->json(['status' => 'ok']);
});

// Add 'api' prefix to route names to avoid conflicts
Route::apiResource('calls', ApiCallController::class)->names([
    'index' => 'api.calls.index',
    'store' => 'api.calls.store',
    'show' => 'api.calls.show',
    'update' => 'api.calls.update',
    'destroy' => 'api.calls.destroy',
]);

// Add 'api' prefix to other API routes
Route::apiResource('clients', ClientController::class)->names([
    'index' => 'api.clients.index',
    'store' => 'api.clients.store',
    'show' => 'api.clients.show',
    'update' => 'api.clients.update',
    'destroy' => 'api.clients.destroy',
]);

Route::apiResource('agents', AgentController::class)->names([
    'index' => 'api.agents.index',
    'store' => 'api.agents.store',
    'show' => 'api.agents.show',
    'update' => 'api.agents.update',
    'destroy' => 'api.agents.destroy',
]);

Route::apiResource('servers', ServerController::class)->names([
    'index' => 'api.servers.index',
    'store' => 'api.servers.store',
    'show' => 'api.servers.show',
    'update' => 'api.servers.update',
    'destroy' => 'api.servers.destroy',
]);

// Report routes remain unchanged as they don't have naming conflicts
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

Route::apiResource('agents', AgentController::class)->names([
    'index' => 'api.agents.index',
    'store' => 'api.agents.store',
    'show' => 'api.agents.show',
    'update' => 'api.agents.update',
    'destroy' => 'api.agents.destroy',
]);

Route::apiResource('servers', ServerController::class)->names([
    'index' => 'api.servers.index',
    'store' => 'api.servers.store',
    'show' => 'api.servers.show',
    'update' => 'api.servers.update',
    'destroy' => 'api.servers.destroy',
]);

// Report routes remain unchanged as they don't have naming conflicts
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