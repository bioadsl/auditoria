<?php

use App\Http\Controllers\CallController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('calls.index');
});

Route::resource('calls', CallController::class);
