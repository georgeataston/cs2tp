<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BasketController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\StockController;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\Order;
use App\Models\PasswordReset;
use App\Models\Review;
use App\Models\Size;
use App\Models\Stock;
use App\Http\Controllers\ContactFormController;
use App\Http\Middleware\AdminSessionValidator;
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
Route::post('/account/update/details', [AccountController::class, 'updateDetails'])->middleware(SessionValidator::class);
Route::post('/account/update/password', [AccountController::class, 'updatePassword'])->middleware(SessionValidator::class);

Route::post('/contact', [ContactFormController::class, 'create']);

Route::post('/basket/add', [BasketController::class, 'add']);
Route::post('/basket/remove', [BasketController::class, 'remove']);

Route::post('/orders/checkout', [OrderController::class, 'checkout']);

Route::post('/reviews/create', [ReviewController::class, 'create'])->middleware(SessionValidator::class);
Route::post('/admin/reviews/edit', [ReviewController::class, 'edit'])->middleware(AdminSessionValidator::class);
Route::post('/admin/reviews/delete', [ReviewController::class, 'delete'])->middleware(AdminSessionValidator::class);
Route::post('/admin/reviews/restore', [ReviewController::class, 'restore'])->middleware(AdminSessionValidator::class);

Route::post('/admin/orders/api/pick', [OrderController::class, 'pick'])->middleware(AdminSessionValidator::class);
Route::post('/admin/orders/api/unpick', [OrderController::class, 'unpick'])->middleware(AdminSessionValidator::class);
Route::post('/admin/orders/api/complete', [OrderController::class, 'complete'])->middleware(AdminSessionValidator::class);

Route::post('/admin/stock/api/brands/create', [StockController::class, 'createBrand'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/brands/update', [StockController::class, 'updateBrand'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/brands/delete', [StockController::class, 'deleteBrand'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/categories/create', [StockController::class, 'createCategory'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/categories/update', [StockController::class, 'updateCategory'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/categories/delete', [StockController::class, 'deleteCategory'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/create', [StockController::class, 'createStock'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/update', [StockController::class, 'updateStock'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/delete', [StockController::class, 'deleteStock'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/size/create', [StockController::class, 'createSize'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/size/update', [StockController::class, 'updateSizeQuantity'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/size/delete', [StockController::class, 'deleteSize'])->middleware(AdminSessionValidator::class);
Route::post('/admin/stock/api/manage/image/update', [StockController::class, 'updateStockImage'])->middleware(AdminSessionValidator::class);
Route::get('/admin/stock/api/pleaseneverrunmeoutsideofseeding', [StockController::class, 'pleaseNeverRunMeOutsideOfSeeding'])->middleware(AdminSessionValidator::class);

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
Route::get('/help', function() { return view('help'); });
Route::get('/help/account-create', function () { return view('account-create'); });
Route::get('/help/shipping-countries', function () { return view('shipping-countries'); });
Route::get('/help/shipping-tax', function () { return view('shipping-tax'); });
Route::get('/help/shipping-delivery', function () { return view('shipping-delivery'); });
Route::get('/help/shipping-price', function () { return view('shipping-price'); });
Route::get('/help/returns-charges', function () { return view('returns-charges'); });
Route::get('/help/returns-processing', function () { return view('returns-processing'); });
Route::get('/help/returns-policy', function () { return view('returns-policy'); });
Route::get('/footer/privacy-policy', function () { return view('privacy-policy'); });


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
    $stockList = Stock::where('quantity', '>', '0')->where('deleted', '=', '0');
    $shopTitle = "All Products";

    $brands = Brand::where('deleted', '=', '0')->get();

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

    $brands = Brand::where('deleted', '=', '0')->get();

    $brand = Brand::where('bid', '=', $id)->first();
    if ($brand == null || $brand->deleted == 1)
        abort('404');

    $shopTitle = $brand->name;
    $stockList = new Collection;
    $categories = $brand->categories;
    foreach($categories as $cat) {
        if ($cat->deleted == 1)
            continue;

        foreach($cat->items as $item) {
            if ($item->deleted == 1 || $item->isOutOfStock())
                continue;

            $stockList->push($item);
        }
    }

    return view('shop')->with('stockList', $stockList)->with('shopTitle', $shopTitle)->with('brands', $brands);
});

Route::get('/shop/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $stock = Stock::where('id', '=', $id)->first();
    if ($stock == null || $stock->deleted == 1)
        abort('404');

    $sizes = Size::where('stocks_id', '=', $id)->where('deleted', '=', '0')->get();

    $reviews = Review::where('sid', '=', $id);
    if (!session('isAdmin'))
        $reviews = $reviews->where('deleted', '=', '0');
    $reviews = $reviews->get();

    $canLeaveReview = false;
    $hasLeftReview = false;
    if (session('id')) {

        $reviewLeft = Review::where('sid', '=', $id)->where('aid', '=', session('id'))->first();
        if (!$reviewLeft) {
            $orders = Order::where('user_id', '=', session('id'))->get();
            foreach($orders as $order) {
                foreach($order->items as $item) {
                    if ($item->product_id == $stock->id && $item->status == 1 && $order->status == 3) {
                        $canLeaveReview = true;
                        break;
                    }
                }
            }
        } else {
            $hasLeftReview = true;
        }
    }

    // review average
    $reviewTotal = 0;
    $reviewCount = 0;
    foreach($reviews as $review) {
        if ($review->deleted == 1)
            continue;

        $reviewTotal = $reviewTotal + $review->rating;
        $reviewCount = $reviewCount + 1;
    }

    $reviewAverage = 0;
    if ($reviewCount > 0)
        $reviewAverage = $reviewTotal / $reviewCount;

    return view('productdisplay')->with('stock', $stock)
        ->with('sizes', $sizes)
        ->with('reviews', $reviews)
        ->with('canLeaveReview', $canLeaveReview)
        ->with('hasLeftReview', $hasLeftReview)
        ->with('reviewAverage', $reviewAverage)
        ->with('reviewCount', $reviewCount);
});

Route::get('/exampepwdreset', function() {
    return view('mail/password_reset');
});

// Admin routes
Route::get('/admin', function() { return view ('admin/home'); })->middleware(AdminSessionValidator::class);

// Orders
Route::get('/admin/orders', function() {
    $orders = Order::where('status', '<', 3)->get();
    return view ('admin/order/order_processor')->with('orders', $orders)->with('all', false);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/orders/all', function() {
    $orders = Order::orderBy("id", "desc")->get();
    return view ('admin/order/order_processor')->with('orders', $orders)->with('all', true);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/orders/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $order = Order::where('id', '=', $id)->first();
    if ($order == null)
        abort('404');

    $canShip = true;
    foreach ($order->items as $item) {
        if ($item->status == 0)
            $canShip = false;
    }

    if ($order->status != 2)
        $canShip = false;

    return view ('admin/order/order_view')->with('order', $order)->with('canShip', $canShip);
})->middleware(AdminSessionValidator::class);

// Stock
Route::get('/admin/stock', function() {
   return view('admin/stock/home');
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/brands', function() {
    $brands = Brand::all();

    return view('admin/stock/brands/home')->with('brands', $brands);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/brands/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $brand = Brand::where('bid', '=', $id)->first();
    if ($brand == null || $brand->deleted == 1)
        abort('404');

    return view ('admin/stock/brands/view')->with('brand', $brand);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/brands/{id}/delete', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $brand = Brand::where('bid', '=', $id)->first();
    if ($brand == null || $brand->deleted == 1)
        abort('404');

    $categories = Category::where('brand_id', '=', $brand->bid)->where('deleted', '=', '0')->get();

    return view ('admin/stock/brands/delete')->with('brand', $brand)->with('categories', $categories);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/categories', function() {
    $categories = Category::all();
    $brands = Brand::where('deleted', '=', '0')->get();

    return view('admin/stock/categories/home')->with('categories', $categories)->with('brands', $brands);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/categories/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $category = Category::where('cid', '=', $id)->first();
    if ($category == null || $category->deleted == 1)
        abort('404');

    $brands = Brand::where('deleted', '=', '0')->get();

    return view ('admin/stock/categories/view')->with('category', $category)->with('brands', $brands);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/categories/{id}/delete', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $category = Category::where('cid', '=', $id)->first();
    if ($category == null || $category->deleted == 1)
        abort('404');

    return view ('admin/stock/categories/delete')->with('category', $category);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/manage', function() {
    $stocks = Stock::all();
    $categories = Category::where('deleted', '=', '0')->get();

    return view('admin/stock/manage/home')->with('stocks', $stocks)->with('categories', $categories);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/manage/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $stock = Stock::where('id', '=', $id)->first();
    if ($stock == null || $stock->deleted == 1)
        abort('404');

    $categories = Category::where('deleted', '=', '0')->get();
    $sizes = Size::where('stocks_id', '=', $id)->get();

    return view ('admin/stock/manage/view')->with('stock', $stock)->with('categories', $categories)->with('sizes', $sizes);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/manage/{id}/delete', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $stock = Stock::where('id', '=', $id)->first();
    if ($stock == null || $stock->deleted == 1)
        abort('404');

    return view ('admin/stock/manage/delete')->with('stock', $stock);
})->middleware(AdminSessionValidator::class);

Route::get('/admin/stock/manage/size/{id}', function(string $id) {
    if (!is_numeric($id))
        abort('404');

    $size = Size::where('id', '=', $id)->first();
    if ($size == null || $size->deleted == 1)
        abort('404');

    return view ('admin/stock/manage/size/view')->with('size', $size);
})->middleware(AdminSessionValidator::class);

// Accounts
Route::get('/admin/accounts', function() {
    $accounts = Account::all();

    return view('admin/accounts/home')->with('accounts', $accounts);
})->middleware(AdminSessionValidator::class);
