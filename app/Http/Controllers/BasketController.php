<?php

namespace App\Http\Controllers;

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
            // error
        }

        if (!str_starts_with($input['size'], 'UK ')) {
            //error
        }

        // add to session
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            $cart = array();
        }

        array_push($cart, ['id' => $input['id'], 'size' => $input['size'], 'quantity' => $input['quantity']]);
        $request->session()->put('cart', $cart);

        return redirect('/shop/' . $input['id'])->with('success', 'added');
    }

    public function remove(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'id' => 'required|integer'
        ]);

        // remove from session
        $cart = $request->session()->get('cart');
        if (empty($cart)) {
            return redirect('/basket');
        }

        

        return redirect('/basket');
    }
}
