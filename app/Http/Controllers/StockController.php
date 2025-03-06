<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class StockController extends Controller
{
    public function getLowStockItems()
{
    $lowStockItems = Stock::where('quantity', '<=', DB::raw('threshold'))
                          ->orderBy('quantity', 'asc')
                          ->get();

    return response()->json($lowStockItems);
}
Route::get('/low-stock-alerts', [StockController::class, 'getLowStockItems']);

}
