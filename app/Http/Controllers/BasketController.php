<?php

namespace App\Http\Controllers;

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
            'id' => 'required|integer'
        ]);

        if (strtolower($input['size']) == 'select') {
            return back()->withErrors(['size' => 'Please select a size.']);
        }

        if (!str_starts_with($input['size'], 'UK ')) {
            abort(400);
        }

        // add to session
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            $cart = array();
        }

        $stock = Stock::where('id', '=', $input['id'])->first();
        if ($stock == null) {
            abort(400);
        }

        array_push($cart,
            ['id' => $input['id'],
                'size' => $input['size'],
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
            'size' => 'string'
        ]);

        // remove from session
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            return redirect('/basket');
        }

        foreach($cart as $item => $v) {
            if ($v['id'] == $input['id'] && $v['size'] == $input['size']) {
                unset($cart[$item]);
            }
        }

        $request->session()->put('cart', $cart);

        return redirect('/basket');
    }
}
