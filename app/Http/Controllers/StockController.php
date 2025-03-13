<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Stock;
use App\Models\Brand;
use App\Models\Category;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function createBrand(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:brands,name'
        ]);

        $brand = Brand::create(['name' => $request->name]);

        return response()->json(['message' => 'Brand created successfully', 'brand' => $brand], 201);
    }

    public function updateBrand(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $request->validate([
            'name' => 'required|string|unique:brands,name'
        ]);

        $brand->update(['name' => $request->name]);

        return response()->json(['message' => 'Brand updated successfully', 'brand' => $brand]);
    }

    public function deleteBrand($id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update(['deleted' => 1]);

        return response()->json(['message' => 'Brand deleted successfully']);
    }

    public function createCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:categories,name',
            'brand_id' => 'required|exists:brands,bid'
        ]);

        $category = Category::create([
            'name' => $request->name,
            'brand_id' => $request->brand_id
        ]);

        return response()->json(['message' => 'Category created successfully', 'category' => $category], 201);
    }

    public function updateCategory(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|string',
            'brand_id' => 'required|exists:brands,bid'
        ]);

        $category->update([
            'name' => $request->name,
            'brand_id' => $request->brand_id
        ]);

        return response()->json(['message' => 'Category updated successfully', 'category' => $category]);
    }

    public function deleteCategory($id)
    {
        $category = Category::findOrFail($id);
        $category->update(['deleted' => 1]);

        return response()->json(['message' => 'Category deleted successfully']);
    }

    public function createStock(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:stocks,name',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,cid',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $stock = Stock::create($request->all());

        return response()->json(['message' => 'Stock item created successfully', 'stock' => $stock], 201);
    }

    public function updateStock(Request $request, $id)
    {
        $stock = Stock::findOrFail($id);
        $request->validate([
            'name' => 'required|string|unique:stocks,name,' . $id,
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,cid',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0'
        ]);

        $stock->update($request->all());

        return response()->json(['message' => 'Stock item updated successfully', 'stock' => $stock]);
    }

    public function deleteStock($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->update(['deleted' => 1]);

        return response()->json(['message' => 'Stock item deleted successfully']);
    }

    public function updateSizeQuantity(Request $request, $product_id)
    {
        $request->validate([
            'size' => 'required|string',
            'quantity' => 'required|integer|min:0'
        ]);

        $orderItem = OrderItem::where('product_id', $product_id)
            ->where('size', $request->size)
            ->firstOrFail();

        $difference = $request->quantity - $orderItem->quantity;

        DB::transaction(function () use ($orderItem, $difference) {
            $orderItem->update(['quantity' => $orderItem->quantity + $difference]);

            $stock = Stock::findOrFail($orderItem->product_id);
            $stock->update(['quantity' => $stock->quantity + $difference]);
        });

        return response()->json(['message' => 'Size quantity updated successfully']);
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
                $size = new Size();
                $size->stock_id = $stock->id;
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
