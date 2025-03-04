<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\ContactFormController;
use App\Http\Middleware\AdminSessionValidator;
use App\Http\Middleware\ReverseSessionValidator;
use Illuminate\Support\Facades\Route;

// API routes
Route::post('/register', [AccountController::class, 'create'])->middleware(ReverseSessionValidator::class);
Route::post('/login', [AccountController::class, 'authenticate'])->middleware(ReverseSessionValidator::class);
Route::get('/logout', [AccountController::class, 'invalidateSession']);

Route::post('/contact', [ContactFormController::class, 'create']);

// HTML routes
Route::get('/', function() { return view('index'); });
Route::get('/about', function() { return view('about'); });
Route::get('/contact', function() { return view('contact'); });
Route::get('/login', function() { return view('login'); })->middleware(ReverseSessionValidator::class);
Route::get('/signup', function() { return view('signup'); })->middleware(ReverseSessionValidator::class);

// Admin routes
Route::get('/admin', function() { return view ('admin/home'); })->middleware(AdminSessionValidator::class);
Route::get('/admin/categories', function() { return view ('admin/categories'); })->middleware(AdminSessionValidator::class);
Route::get('/admin/orders', function() { return view ('admin/view_orders'); })->middleware(AdminSessionValidator::class);
Route::get('/admin/orders/process', function() { return view ('admin/process_orders'); })->middleware(AdminSessionValidator::class);
Route::get('/admin/reviews', function() { return view ('admin/product_review'); })->middleware(AdminSessionValidator::class);
Route::get('/admin/search', function() { return view ('admin/search_products'); })->middleware(AdminSessionValidator::class);
