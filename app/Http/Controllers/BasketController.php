<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class BasketController extends Controller
{

    /*
     * Added an item to the basket via a POST
     * Must contain the following values:
     * - 'size' -> string
     * - 'quantity' -> number
     * - 'id' -> number
     */
    public function add(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'size' => 'required',
            'quantity' => 'required|integer|min:1',
        ]);

        if (strtolower($input['size']) == 'select') {
            return back()->withErrors(['size' => 'Please select a size.'])->withInput();
        }

        if (!is_numeric($input['size'])) {
            abort(400);
        }

        // add to session
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            $cart = array();
        }

        $size = Size::where('id', '=', $input['size'])->first();
        if ($size == null) {
            abort(400);
        }

        if ($size->isOutOfStock()) {
            return back()->withErrors(['size' => 'This size is out of stock. Nice try, though!'])->withInput();
        }

        $stock = $size->stock;

        if ($size->quantity < $input['quantity']) {
            return back()->withErrors(['quantity' => 'We do not have enough stock for the amount requested.'])->withInput();
        }

        array_push($cart,
            ['id' => $size->id,
                'size' => $size->size,
                'quantity' => $input['quantity'],
                'name' => $stock->category->brand->name . ' ' . $stock->category->name . ' ' . $stock->name,
                'price' => $stock->price]);

        $request->session()->put('cart', $cart);

        return back()->with('success', 'added');
    }

    public function remove(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'id' => 'required|integer',
        ]);

        // remove from session
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            return redirect('/basket');
        }

        foreach($cart as $item => $v) {
            if ($v['id'] == $input['id']) {
                unset($cart[$item]);
            }
        }

        $request->session()->put('cart', $cart);

        return redirect('/basket');
    }
}
