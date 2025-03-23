<?php

namespace App\Http\Controllers;

use App\Models\CuratedOutfit;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class CuratedOutfitController extends Controller
{
    public function createOutfit(Request $request): RedirectResponse {
        $input = $request->validate([
            "image" => "required",
            "description" => "required",
            "copyright" => "required",
            "stock_id" => "required",
        ]);

        $stock = Stock::where('id', '=', $input['stock_id'])->first();
        if (!$stock)
            abort(400);

        if ($stock->curatedOutfit != null)
            abort(400);

        $curatedOutfit = new CuratedOutfit;
        $curatedOutfit->stock_id = $stock->id;
        $curatedOutfit->image_url = $input['image'];
        $curatedOutfit->description = $input['description'];
        $curatedOutfit->copyright = $input['copyright'];
        $curatedOutfit->save();

        return back()->with('success', 'Curated outfit created successfully.');
    }

    public function updateOutfit(Request $request): RedirectResponse {
        $input = $request->validate([
            "image" => "required",
            "description" => "required",
            "copyright" => "required",
            "outfit_id" => "required",
        ]);

        $curatedOutfit = CuratedOutfit::where('id', '=', $input['outfit_id'])->first();
        if (!$curatedOutfit)
            abort(400);

        $curatedOutfit->image_url = $input['image'];
        $curatedOutfit->description = $input['description'];
        $curatedOutfit->copyright = $input['copyright'];
        $curatedOutfit->save();

        return back()->with('success', 'Curated outfit updated successfully.');
    }

    public function deleteOutfit(Request $request): RedirectResponse {
        $input = $request->validate([
            "outfit_id" => "required"
        ]);

        $curatedOutfit = CuratedOutfit::where('id', '=', $input['outfit_id'])->first();
        if (!$curatedOutfit)
            abort(400);

        $curatedOutfit->delete();

        return back()->with('success', 'Curated outfit deleted successfully.');
    }
}
