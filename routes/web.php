<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProblemDescriptionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\AgentsController;
use Illuminate\Support\Facades\Route;

// Rotas para visitantes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Rota de logout
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Rotas autenticadas
Route::middleware('auth')->group(function () {
    // Rota inicial
    Route::get('/', function () {
        return redirect()->route('calls.index');
    })->name('home');
    
    // Rotas de chamados
    Route::resource('calls', CallController::class);
    
    // Rotas de servidores
    Route::prefix('servers')->group(function () {
        Route::get('search', [ServerController::class, 'search'])->name('servers.search');
        Route::get('autocomplete', [ServerController::class, 'autocomplete'])->name('servers.autocomplete');
    });
    Route::resource('servers', ServerController::class);
    
    // Web routes para agentes (usando AgentsController para views)
    Route::resource('agents', AgentsController::class);
    
    // Rotas de descrições de problemas
    Route::prefix('problem-descriptions')->group(function () {
        Route::get('search', [ProblemDescriptionController::class, 'search'])
            ->name('problem-descriptions.search');
        Route::get('autocomplete', [ProblemDescriptionController::class, 'autocomplete'])
            ->name('problem-descriptions.autocomplete');
    });
    Route::resource('problem-descriptions', ProblemDescriptionController::class)->names([
        'index' => 'problem_descriptions.index',
        'create' => 'problem_descriptions.create',
        'store' => 'problem_descriptions.store',
        'show' => 'problem_descriptions.show',
        'edit' => 'problem_descriptions.edit',
        'update' => 'problem_descriptions.update',
        'destroy' => 'problem_descriptions.destroy'
    ]);
    
    // Rotas de relatórios
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('/dashboard', [ReportController::class, 'dashboardView'])->name('dashboard');
        Route::get('/calls', [ReportController::class, 'callsView'])->name('calls');
        Route::get('/actions', [ReportController::class, 'actionsView'])->name('actions');
        Route::get('/status', [ReportController::class, 'statusView'])->name('status');
        Route::get('/remote-access', [ReportController::class, 'remoteAccessView'])->name('remote-access');
        Route::get('/monthly', [ReportController::class, 'monthlyView'])->name('monthly');
        Route::get('/quality', [ReportController::class, 'qualityView'])->name('quality');
        Route::get('/import', [ImportController::class, 'index'])->name('import.index');
        Route::post('/import', [ImportController::class, 'import'])->name('import.process');
    });
});