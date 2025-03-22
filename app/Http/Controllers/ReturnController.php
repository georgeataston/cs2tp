<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\ReturnItem;
use App\Models\Returns;
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

        if ($order->status != 3)
            return back()->withInput()->withErrors(['submit' => 'This is order is still processing, therefore you cannot start a return right now. Need more help? Please contact us.']);

        $items = new Collection;
        foreach($order->items as $item) {
            $returnItem = ReturnItem::where('order_item_id', '=', $item->id)->first();
            if (!$returnItem)
                $items->push($item);
        }

        if ($items->count() == 0)
            return back()->withInput()->withErrors(['submit' => 'You do not have any items on this order eligible for a refund. This may be because you have not received the items yet or you have already requested a refund.']);

        return redirect('/returns')->with('continue', 'continue')->with('items', $items)->with('order', $input['order'])->with('email', $input['email']);
    }

    public function checkReturn(Request $request): RedirectResponse {
        $input = $request->validate([
            'reference' => 'required|integer',
            'email' => 'required|email',
        ]);

        $return = Returns::where('id', '=', $input['reference'])->first();
        if (!$return)
            return back()->withInput()->withErrors(['status-submit' => 'We are unable to locate your return. Please check your input. Need more help? Contact us quoting "R3".']);

        if ($return->order->email != $input['email'])
            return back()->withInput()->withErrors(['status-submit' => 'We are unable to locate your order. Please check your input. Need more help? Contact us quoting "R4".']);

        $items = $return->items;
        $message = "";
        if ($return->status == 0)
            $message = "Thank you for your request. We will process it shortly.";
        else if ($return->status == 1 || $return->status == 6)
            $message = "Thank you for your request. Unfortunately we are unable to approve your refund. If you sent any items back to us, please get in touch to arrange a re-delivery.";
        else if ($return->status == 7)
            $message = "Thank you for your request. Unfortunately, we were only able to approve some of your return items. If you sent any items back to us, please get in touch to arrange a re-delivery.";
        else if ($return->status == 5)
            $message = "Thank you for your request. We have approved your refund. Your return will be credited back to your payment card.";
        else
            $message = "Thank you for your request. Something has gone wrong, and we cannot confirm your return status right now. Please try again later or contact us.";

        return redirect('/returns')->with('check', 'check')->with('items', $items)->with('checkMessage', $message);
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

        $return = new Returns;
        $return->order_id = $order->id;
        $return->reason = $input['reason'];
        $return->status = 0;
        $return->save();

        foreach ($toReturn as $item) {
            $returnItem = new ReturnItem;
            $returnItem->return_id = $return->id;
            $returnItem->order_item_id = $item->id;
            $returnItem->quantity = 1; //for now
            $returnItem->status = 0;
            $returnItem->save();
        }

        return redirect('/returns')->with('success', 'Your return request has been submitted for review successfully. Your reference number is #' . $return->id . '.');
    }


    public function updateReturnItemStatus(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'return_item_id' => 'required|integer',
            'status' => 'required|integer',
        ]);

        $returnItem = ReturnItem::where('id', $input['return_item_id'])->first();
        if (!$returnItem) {
            return back()->with('error', 'Return item not found.');
        }

        $returnItem->status = $input['status'];
        $returnItem->save();

        $returnItem->return->status = 1;
        $returnItem->return->save();

        return back();
    }


    public function signOff(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'return_id' => 'required|integer',
        ]);

        $return = Returns::where('id', $input['return_id'])->first();
        if (!$return) {
            return back()->with('error', 'Return request not found.');
        }

        $approveCount = 0;
        $declineCount = 0;
        foreach($return->items as $item) {
            if ($item->status == 1 || $item->status == 5)
                $declineCount++;
            else if ($item->status == 4)
                $approveCount++;
            else
                return back()->with('error', 'Return is not in a state to sign off.');
        }

        if ($approveCount != 0 && $declineCount != 0) // partial refund
            $return->status = 7;
        else if ($approveCount > 0 && $declineCount == 0)
            $return->status = 5;
        else if ($approveCount == 0 && $declineCount > 0)
            $return->status = 6;
        else
            return back()->with('error', 'Something went wrong. Please try again later. (Error code ' . $approveCount . '-' . $declineCount . ')');

        $return->save();

        return redirect('/admin/returns')->with('success', 'Return #' . $return->id . ' signed off successfully.');
    }
}
