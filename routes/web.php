<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Models\Order;
use App\Models\Stock;
use App\Http\Controllers\ContactFormController;
use App\Http\Middleware\ReverseSessionValidator;
use App\Http\Middleware\SessionValidator;
use App\Models\Account;
use Illuminate\Support\Facades\Route;

// API routes
Route::post('/register', [AccountController::class, 'create'])->middleware(ReverseSessionValidator::class);
Route::post('/login', [AccountController::class, 'authenticate'])->middleware(ReverseSessionValidator::class);
Route::get('/logout', [AccountController::class, 'invalidateSession']);

Route::post('/contact', [ContactFormController::class, 'create']);

Route::post('/basket/add', [BasketController::class, 'add']);
Route::post('/basket/remove', [BasketController::class, 'remove']);

Route::post('/orders/checkout', [OrderController::class, 'checkout']);

// HTML routes
Route::get('/', function() { return view('index'); });
Route::get('/about', function() { return view('about'); });
Route::get('/contact', function() { return view('contact'); });
Route::get('/login', function() { return view('login'); })->middleware(ReverseSessionValidator::class);
Route::get('/signup', function() { return view('signup'); })->middleware(ReverseSessionValidator::class);

// Basket

Route::get('/basket', function() {
    $cart = session('cart');
    if (empty($cart) || sizeof($cart) == 0) {
        return view('basket')->with('empty', 'true');
    }

    $items = array();
    $total = 0;
    foreach ($cart as $item) {
        $stock = Stock::where('id', '=', $item['id'])->first();
        if ($stock == null)
            continue;

        $total += $stock->price;
        array_push($items, $stock);
    }
    unset($item);

    return view('basket')->with('items', $items)->with('total', $total);
});

Route::get('/basket/checkout', function() {
    $cart = session('cart');
    if (empty($cart) || sizeof($cart) == 0) {
        return view('basket')->with('empty', 'true');
    }

    $items = array();
    $total = 0;
    foreach ($cart as $item) {
        $stock = Stock::where('id', '=', $item['id'])->first();
        if ($stock == null)
            continue;

        $total += $stock->price;
        array_push($items, $stock);
    }
    unset($item);

    // Check for logged in
    $id = session('id');
    if ($id == null) {
        return view('checkout')->with('items', $items)->with('total', $total);
    }

    $user = Account::where('aid', '=', $id)->first();
    if ($user == null) {
        return view('checkout')->with('items', $items)->with('total', $total);
    }

    return view('checkout')->with('items', $items)->with('total', $total)->with('user', $user);
});

Route::get('/basket/thankyou', function() { return view('thankyou'); });

// Accounts

Route::get('/account', function() {
    $account = Account::where('aid', '=', session('id'))->first();
    $name = preg_split("/\s/", $account->name)[0];
    $fullName = $account->name;
    $email = $account->email;

    $orders = Order::where('user_id', '=', session('id'))->get();
    if ($orders == null)
        $orders = array();

    return view('useraccount')->with('name', $name)->with('email', $email)->with('fullName', $fullName)->with('orders', $orders);
})->middleware(SessionValidator::class);


// Shop

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
