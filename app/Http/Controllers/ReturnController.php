<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReturnController extends Controller
{
    public function startReturn(Request $request): RedirectResponse {
        $input = $request->validate([
            'order' => 'required|integer',
            'email' => 'required|email',
        ]);

        $order = Order::where('id', '=', $input['order'])->first();
        if (!$order)
            return back()->withInput()->withErrors(['submit' => 'We are unable to locate your order. Please check your input. Need more help? Contact us quoting "R1".']);

        if ($order->email != $input['email'])
            return back()->withInput()->withErrors(['submit' => 'We are unable to locate your order. Please check your input. Need more help? Contact us quoting "R2".']);

        $items = $order->items;

        return redirect('/returns')->with('continue', 'continue')->with('items', $items)->with('order', $input['order'])->with('email', $input['email']);
    }

    public function finishReturn(Request $request): RedirectResponse {
        $input = $request->validate([
            'order' => 'required|integer',
            'email' => 'required|email',
            'reason' => 'required'
        ]);

        $order = Order::where('id', '=', $input['order'])->first();
        if (!$order)
            return back()->withInput()->withErrors(['submit' => 'We are unable to locate your order. Please check your input. Need more help? Contact us quoting "R1".']);

        if ($order->email != $input['email'])
            return back()->withInput()->withErrors(['submit' => 'We are unable to locate your order. Please check your input. Need more help? Contact us quoting "R2".']);


        $items = $order->items;
        $toReturn = new Collection;
        foreach($items as $item) {
            if ($request->input('item-' . $item->id)) {
                $toReturn->push($item);
            }
        }

        if ($toReturn->count() == 0)
            return redirect('/returns')->with('continue', 'continue')->with('items', $items)->with('order', $input['order'])->with('email', $input['email'])->withInput()->withErrors(['submit' => 'Please select item(s) to return.']);
        

        return redirect('/');
    }
}
