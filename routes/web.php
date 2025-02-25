<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Models\Brand;
use App\Models\Feature;
use App\Models\Order;
use App\Models\PasswordReset;
use App\Models\Stock;
use App\Http\Controllers\ContactFormController;
use App\Http\Middleware\ReverseSessionValidator;
use App\Http\Middleware\SessionValidator;
use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// API routes
Route::post('/register', [AccountController::class, 'create'])->middleware(ReverseSessionValidator::class);
Route::post('/login', [AccountController::class, 'authenticate'])->middleware(ReverseSessionValidator::class);
Route::get('/logout', [AccountController::class, 'invalidateSession']);
Route::post('/recovery', [AccountController::class, 'requestPasswordReset'])->middleware(ReverseSessionValidator::class);
Route::post('/recovery/reset', [AccountController::class, 'forgottenPasswordReset'])->middleware(ReverseSessionValidator::class);

Route::post('/contact', [ContactFormController::class, 'create']);

Route::post('/basket/add', [BasketController::class, 'add']);
Route::post('/basket/remove', [BasketController::class, 'remove']);

Route::post('/orders/checkout', [OrderController::class, 'checkout']);

// HTML routes
Route::get('/', function() {
    $featuresRaw = Feature::all();
    $features = new Collection;
    foreach($featuresRaw as $feat) {
        $features->push($feat->item);
    }
    return view('index')->with('features', $features);
});

Route::get('/about', function() { return view('about'); });
Route::get('/contact', function() { return view('contact'); });
Route::get('/help', function () { return view('help');
Route::get('/login', function() { return view('login'); })->middleware(ReverseSessionValidator::class);
Route::get('/signup', function() { return view('signup'); })->middleware(ReverseSessionValidator::class);

Route::get('/recovery/{token?}', function (?string $token = null) {
    if (!$token)
        return view('password_recovery');

    $reset = PasswordReset::where('token', '=', $token)->first();
    if (!$reset) {
        return redirect('/recovery')->with("error", "Request is invalid or has expired.");
    }

    if (time() > $reset->expiry) {
        $reset->delete();
        return redirect('/recovery')->with("error", "Request is invalid or has expired.");
    }

    return view('password_reset')->with("token", $token);
})->middleware(ReverseSessionValidator::class);

// Basket

Route::get('/basket', function() {
    $cart = session('cart');
    if (empty($cart) || sizeof($cart) == 0) {
        return view('basket')->with('empty', 'true');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    unset($item);

    return view('basket')->with('cart', $cart)->with('total', $total);
});

Route::get('/basket/checkout', function() {
    $cart = session('cart');
    if (empty($cart) || sizeof($cart) == 0) {
        return view('basket')->with('empty', 'true');
    }

    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    unset($item);

    // Check for logged in
    $id = session('id');
    if ($id == null) {
        return view('checkout')->with('cart', $cart)->with('total', $total);
    }

    $user = Account::where('aid', '=', $id)->first();
    if ($user == null) {
        return view('checkout')->with('cart', $cart)->with('total', $total);
    }

    return view('checkout')->with('cart', $cart)->with('total', $total)->with('user', $user);
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

Route::get('/shop', function(Request $request) {
    $stockList = Stock::where('quantity', '>', '0');
    $shopTitle = "All Products";

    $brands = Brand::all();

    $searchQuery = $request->query('search');
    if ($searchQuery != null) {
        $stockList = $stockList->where('name', 'LIKE', '%'.$searchQuery.'%');
        $shopTitle = "Search Results for $searchQuery";
    }

    $stockList = $stockList->get();
    return view('shop')->with('stockList', $stockList)->with("shopTitle", $shopTitle)->with('brands', $brands);
});

Route::get('/shop/brand/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $brands = Brand::all();

    $brand = Brand::where('bid', '=', $id)->first();
    if ($brand == null)
        abort('404');

    $shopTitle = $brand->name;
    $stockList = new Collection;
    $categories = $brand->categories;
    foreach($categories as $cat) {
        foreach($cat->items as $item) {
            $stockList->push($item);
        }
    }

    return view('shop')->with('stockList', $stockList)->with('shopTitle', $shopTitle)->with('brands', $brands);
});

Route::get('/shop/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $stock = Stock::where('id', '=', $id)->first();
    if ($stock == null)
        abort('404');

    return view('productdisplay')->with('stock', $stock);
});

Route::get('/exampepwdreset', function() {
    return view('mail/password_reset');
});
