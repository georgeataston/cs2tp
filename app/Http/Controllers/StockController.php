<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Size;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function createBrand(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|string'
        ]);

        $brand = new Brand;
        $brand->name = $input['name'];
        $brand->save();

        return redirect('/admin/stock/brands')->with('success', 'Brand created successfully.');
    }

    public function updateBrand(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|integer'
        ]);

        $brand = Brand::where('bid', '=', $input['brand_id'])->first();
        if (!$brand)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (BID' . $input['brand_id'] . ')']);

        $brand->name = $input['name'];
        $brand->save();

        return redirect('/admin/stock/brands/' . $brand->bid)->with('success', 'Brand updated successfully.');
    }

    public function deleteBrand(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'brand_id' => 'required|integer'
        ]);

        $brand = Brand::where('bid', '=', $input['brand_id'])->first();
        if (!$brand)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (BID' . $input['brand_id'] . ')']);

        $brand->deleted = 1;
        $brand->save();

        return redirect('/admin/stock/brands/')->with('success', 'Brand \'' . $brand->name . '\' archived successfully.');
    }

    public function createCategory(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|integer'
        ]);

        $brand = Brand::where('bid', '=', $input['brand_id'])->first();
        if (!$brand)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (BID' . $input['brand_id'] . ')']);

        $category = new Category;
        $category->brand_id = $brand->bid;
        $category->name = $input['name'];
        $category->save();

        return redirect('/admin/stock/categories')->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'brand_id' => 'required|integer',
            'name' => 'required|string',
            'category_id' => 'required|integer'
        ]);

        $category = Category::where('cid', '=', $input['category_id'])->first();
        if (!$category)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (CID' . $input['category_id'] . ')']);

        $brand = Brand::where('bid', '=', $input['brand_id'])->first();
        if (!$brand)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (BID' . $input['brand_id'] . ')']);

        $category->brand_id = $brand->bid;
        $category->name = $input['name'];
        $category->save();

        return redirect('/admin/stock/categories/' . $category->cid)->with('success', 'Category updated successfully.');
    }

    public function deleteCategory(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'category_id' => 'required|integer'
        ]);

        $category = Category::where('cid', '=', $input['category_id'])->first();
        if (!$category)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (CID' . $input['category_id'] . ')']);

        $category->deleted = 1;
        $category->save();

        return redirect('/admin/stock/categories/')->with('success', 'Category \'' . $category->name . '\' archived successfully.');
    }

    public function createStock(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string|unique:stocks,name',
            'price' => 'required|numeric|min:0',
            'image' => 'required|string',
            'description' => 'nullable|string',
        ]);

        $stock = new Stock;
        $stock->name = $input['name'];
        $stock->description = $input['description'];
        $stock->category_id = $input['category_id'];
        $stock->quantity = 0;
        $stock->price = $input['price'];
        $stock->save();

        $image = new Image;
        $image->stock_id = $stock->id;
        $image->image_path = $input['image'];
        $image->save();

        return redirect('/admin/stock/manage/' . $stock->id)->with('success', 'Stock create successfully.');
    }

    public function updateStock(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'category_id' => 'required|integer',
            'name' => 'required|string',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock_id' => 'required|integer'
        ]);

        $stock = Stock::where('id', '=', $input['stock_id'])->first();
        if (!$stock)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (SID' . $input['stock_id'] . ')']);

        $category = Category::where('cid', '=', $input['category_id'])->first();
        if (!$category)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (CID' . $input['category_id'] . ')']);

        $stock->category_id = $input['category_id'];
        $stock->name = $input['name'];
        $stock->description = $input['description'];
        $stock->price = $input['price'];
        $stock->save();

        return redirect('/admin/stock/manage/' . $stock->id)->with('success', 'Stock updated successfully.');
    }

    public function deleteStock(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'stock_id' => 'required|integer'
        ]);

        $stock = Stock::where('id', '=', $input['stock_id'])->first();
        if (!$stock)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (SID' . $input['stock_id'] . ')']);

        $stock->deleted = 1;
        $stock->save();

        return redirect('/admin/stock/manage/')->with('success', 'Stock \'' . $stock->name . '\' archived successfully.');
    }

    public function updateStockImage(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'image' => 'required|string',
            'image_id' => 'required|integer',
            'stock_id' => 'required|integer'
        ]);

        $image = Image::where('id', '=', $input['image_id'])->first();
        if (!$image)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (IMGID' . $input['image_id'] . ')']);

        $image->image_path = $input['image'];
        $image->save();

        return redirect('/admin/stock/manage/' . $input['stock_id'])->with('success', 'Image updated successfully.');
    }

    public function createSize(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'size' => 'required|string',
            'stock_id' => 'required|integer'
        ]);

        $stock = Stock::where('id', '=', $input['stock_id'])->first();
        if (!$stock)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (SID' . $input['stock_id'] . ')']);

        $size = new Size;
        $size->stocks_id = $stock->id;
        $size->size = $input['size'];
        $size->quantity = 0;
        $size->save();

        return redirect('/admin/stock/manage/' . $stock->id)->with('success', 'Size created successfully.');
    }

    public function updateSizeQuantity(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'quantity' => 'required|integer|min:0',
            'size_id' => 'required|integer'
        ]);

        $size = Size::where('id', '=', $input['size_id'])->first();
        if (!$size)
            return back()->withInput()->withErrors(['submit' => 'An internal error occurred. Please try again later. (SZID' . $input['size_id'] . ')']);

        $difference = (int)$size->quantity - (int)$input['quantity'];

        $size->stock->quantity = $size->stock->quantity - $difference;
        $size->stock->save();

        $size->quantity = $input['quantity'];
        $size->save();

        return redirect('/admin/stock/manage/size/' . $size->id)->with('success', 'Size updated successfully.');
    }

    public function pleaseNeverRunMeOutsideOfSeeding(Request $request): Response
    {
        if ($request->session()->get('id') != 1) {
            abort(418);
        }

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
