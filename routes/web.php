<?php

use App\Http\Controllers\AccountController;
use App\Models\Stock;
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

Route::get('/shop', function() { return view('shop'); });
Route::get('/shop/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $stock = Stock::where('id', '=', $id)->first();
    if ($stock == null)
        abort('404');

    return view('productdisplay')->with('stock', $stock);
});
