<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class OrderController extends Controller
{

    /*
     * ORDER STATUS CODES
     * 0 - created
     * 1 - part-processed
     * 2 - processed
     * 3 - complete
     * 4 - cancelled (by merchant)
     * 5 - cancelled (by customer)
     */

    /*
     * ORDER ITEM STATUS CODES
     * 0 - unpicked
     * 1 - picked
     */


    /*
     * Checkouts a session via a POST
     * Must contain the following string values
     * - 'fullName'
     * - 'email'
     * - 'addressLineOne'
     * - 'addressLineTwo'
     * - 'city'
     * - 'postCode'
     * - 'cardNumber'
     * - 'cardName'
     * - 'cardExpiry'
     * - 'cardCVV'
     */
    public function checkout(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'fullName' => 'required|max:255',
            'email' => 'required|email|max:255',
            'addressLineOne' => 'required|max:255',
            'addressLineTwo' => 'max:255',
            'city' => 'required|max:255',
            'postCode' => 'required|max:255',
            'cardNumber' => 'required|min_digits:16|max_digits:16',
            'cardName' => 'required',
            'cardExpiry' => 'required',
            'cardCVV' => 'required|integer|min_digits:3|max_digits:3',
        ]);

        $cart = $request->session()->get('cart');
        if (empty($cart) || sizeof($cart) == 0) {
            abort(400);
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price']*$item['quantity'];
        }
        unset($item);

        // create the order
        $order = new Order;
        if ($request->session()->get('id') != null) {
            $order->user_id = $request->session()->get('id');
            $order->fullName = $input['fullName'];
            $order->email = $input['email'];
        } else {
            $order->fullName = $input['fullName'];
            $order->email = $input['email'];
        }

        $order->total_price = $total;
        $order->status = 0;

        $order->addressLineOne = $input['addressLineOne'];
        $order->addressLineTwo = $input['addressLineTwo'];
        $order->city = $input['city'];
        $order->postCode = $input['postCode'];
        $order->save();

        // load items into order_items
        foreach($cart as $item) {
            $orderItem = new OrderItem;
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $item['id'];
            $orderItem->size = $item['size'];
            $orderItem->quantity = $item['quantity'];
            $orderItem->price = $item['price'];
            $orderItem->status = 0;
            $orderItem->save();
        }

        // clear basket
        $request->session()->put('cart', array());

        return redirect('/basket/thankyou')->with('total', $total)->with("orderId", $order->id)->with("email", $input['email']);
    }

    /*
    * Admin POST for marking order items as picked.
    * Must contain the following numerical values
    * - 'order_id'
    * - 'order_item_id'
    */
    public function pick(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'order_id' => 'required|integer',
            'order_item_id' => 'required|integer',
        ]);

        $order = Order::where('id', '=', $input['order_id'])->first();
        $orderItem = OrderItem::where('id', '=', $input['order_item_id'])->first();

        if ($order == null || $orderItem == null)
            abort('400');

        if ($orderItem->order_id != $order->id)
            abort('400');

        $orderItem->status = 1;
        $orderItem->save();

        $allPicked = true;
        foreach ($order->items as $item) {
            if ($item->status == 0)
                $allPicked = false;
        }

        if (!$allPicked) {
            $order->status = 1;
        } else {
            $order->status = 2;
        }

        $order->save();

        return redirect('/admin/orders/' . $order->id);
    }

    /*
    * Admin POST for marking order items as unpicked.
    * Must contain the following numerical values
    * - 'order_id'
    * - 'order_item_id'
    */
    public function unpick(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'order_id' => 'required|integer',
            'order_item_id' => 'required|integer',
        ]);

        $order = Order::where('id', '=', $input['order_id'])->first();
        $orderItem = OrderItem::where('id', '=', $input['order_item_id'])->first();

        if ($order == null || $orderItem == null)
            abort('400');

        if ($orderItem->order_id != $order->id)
            abort('400');

        $orderItem->status = 0;
        $orderItem->save();

        $allPicked = true;
        $amountPicked = 0;
        foreach ($order->items as $item) {
            if ($item->status == 0)
                $allPicked = false;
            else if ($item->status == 1)
                $amountPicked = $amountPicked + 1;
        }

        if (!$allPicked) {
            $order->status = 1;
        } else {
            $order->status = 2;
        }

        if ($amountPicked == 0)
            $order->status = 0;

        $order->save();

        return redirect('/admin/orders/' . $order->id);
    }

    /*
    * Admin POST for marking orders as complete
    * Must contain the following numerical values
    * - 'order_id'
    */
    public function complete(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'order_id' => 'required|integer',
        ]);

        $order = Order::where('id', '=', $input['order_id'])->first();
        if ($order == null)
            abort('400');

        if ($order->status != 2)
            abort('400');

        $allPicked = true;
        foreach ($order->items as $item) {
            if ($item->status == 0)
                $allPicked = false;
        }

        if (!$allPicked)
            abort('400');

        $order->status = 3;
        $order->save();

        return redirect('/admin/orders')->with('success', 'Order successfully marked as completed.');
    }
}
