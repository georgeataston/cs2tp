<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class StockController extends Controller
{
    public function pleaseNeverRunMeOutsideOfSeeding(Request $request): Response {
        if ($request->session()->get('id') != 1)
            abort(418);


        $stockList = Stock::all();
        foreach ($stockList as $stock) {
            $amt = 4;
            $totalQuantity = 0;
            while ($amt <= 13) {
                $rand = rand(0, 15);
                $size = new Size;
                $size->stocks_id = $stock->id;
                $size->size = "UK " . $amt;
                $size->quantity = $rand;
                $size->save();
                $amt += 1;
                $totalQuantity += $rand;
            }

            $stock->quantity = $totalQuantity;
            $stock->save();
        }

        return response(null, 200);
    }
}
