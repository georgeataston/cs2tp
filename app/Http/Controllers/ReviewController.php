<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Order;
use App\Models\Review;
use App\Models\Stock;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ReviewController extends Controller
{
    /*
     * POST - Creates a review
     * Requires the following values:
     * - 'sid' - stock id
     * - 'rating' - integer 1-5
     * - 'title'
     * - 'content'
     */
    public function create(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'sid' => 'required|integer',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        // Security checks

        // ensure we are logged in and have a valid session
        if (!$request->session()->has('id')) {
            return back()->withInput()->withErrors('submit', 'Despite the website allowing you to leave a review, you are somehow not logged in! Please refresh the page or log out and log back in to refresh your session.');
        }

        $userId = $request->session()->get('id');
        $user = Account::where('id', '=', $userId)->first();

        // ensure user actually exists
        if (!$user) {
            return back()->withInput()->withErrors('submit', 'Apparently your account does not exist! Please refresh the page or log out and log back in to refresh your session.');
        }

        $item = Stock::where('id', '=', $input['sid'])->first();
        if (!$item)
            abort(400);

        // ensure they have bought the item
        $hasBoughtItem = false;
        $orders = Order::where('user_id', '=', $userId)->get();
        foreach($orders as $order) {
            foreach($order->items as $item) {
                if ($item->product_id == $item->id && $item->status == 1) {
                    $hasBoughtItem = true;
                    break;
                }
            }
        }

        if (!$hasBoughtItem) {
            return back()->withInput()->withErrors('submit', 'Despite the website allowing you to leave a review, you have not bought this item. Please do so to leave a review!');
        }

        // Review

        $review = new Review;
        $review->aid = $userId;
        $review->sid = $item->id;
        $review->rating = $input['rating'];
        $review->title = $input['title'];
        $review->content = $input['content'];
        $review->save();

        return redirect('/shop/' . $item->id)->with("review_success", "Your review has been submitted. Thank you!");
    }
}
