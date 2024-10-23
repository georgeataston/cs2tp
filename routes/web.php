<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// API routes
Route::post('/register', [AccountController::class, 'create']);

// HTML routes
Route::get('/', function () {
    return view('welcome');
});
