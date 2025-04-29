<?php

use App\Http\Controllers\CallController;
use App\Http\Controllers\ServerController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('calls.index');
})->name('home');

Route::resource('calls', CallController::class);

Route::get('/autocomplete/servers', [ServerController::class, 'autocomplete'])->name('autocomplete.servers');
Route::get('/autocomplete/problem-descriptions', [ProblemDescriptionController::class, 'autocomplete'])->name('autocomplete.problem-descriptions');

Route::post('/servers', [ServerController::class, 'store'])->name('servers.store');
Route::post('/problem-descriptions', [ProblemDescriptionController::class, 'store'])->name('problem-descriptions.store');

Route::get('/dashboard', function () {
    return view('dashboard.index');
})->name('dashboard');
