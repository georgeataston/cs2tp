<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;

// API routes
Route::post('/register', [AccountController::class, 'create']);
Route::post('/login', [AccountController::class, 'authenticate']);
Route::get('/logout', [AccountController::class, 'invalidateSession']);

// HTML routes
Route::get('/', function() { return view('index'); });
Route::get('/about', function() { return view('about'); });
Route::get('/contact', function() { return view('contact'); });
Route::get('/signup', function() { return view('signup'); });