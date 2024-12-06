<?php

use App\Http\Controllers\AccountController;
use App\Models\Stock;
use App\Http\Controllers\ContactFormController;
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

Route::get('/shop', function() {
    $stockList = Stock::where('quantity', '>', '0')->get();

    return view('shop')->with('stockList', $stockList);
});
Route::get('/shop/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $stock = Stock::where('id', '=', $id)->first();
    if ($stock == null)
        abort('404');

    return view('productdisplay')->with('stock', $stock);
});
