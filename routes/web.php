<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\ProblemDescriptionController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// Guest routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('calls.index');
    })->name('home');
    
    Route::resource('calls', CallController::class);
    Route::get('/autocomplete/servers', [ServerController::class, 'autocomplete'])->name('autocomplete.servers');
    Route::get('/autocomplete/problem-descriptions', [ProblemDescriptionController::class, 'autocomplete'])
        ->name('autocomplete.problem-descriptions');
});