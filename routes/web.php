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
Route::middleware(['web', 'auth'])->group(function () {
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
    
    // API routes para agentes
    Route::prefix('api')->group(function () {
        Route::resource('agent', AgentController::class);
    });
    
    // Web routes para agentes
    Route::resource('agents', AgentsController::class);
    
    // Rotas de descrições de problemas
    Route::prefix('problem-descriptions')->group(function () {
        Route::get('autocomplete', [ProblemDescriptionController::class, 'autocomplete'])
            ->name('problem_descriptions.autocomplete');
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
});
