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
            'rating' => 'required|integer|min:0|max:5',
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        if ($input['rating'] == 0) {
            return back()->withInput()->withErrors('rating', 'Please select a rating.');
        }

        // Security checks

        // ensure we are logged in and have a valid session
        if (!$request->session()->has('id')) {
            return back()->withInput()->withErrors('submit', 'Despite the website allowing you to leave a review, you are somehow not logged in! Please refresh the page or log out and log back in to refresh your session.');
        }

        $userId = $request->session()->get('id');
        $user = Account::where('aid', '=', $userId)->first();

        // ensure user actually exists
        if (!$user) {
            return back()->withInput()->withErrors('submit', 'Apparently your account does not exist! Please refresh the page or log out and log back in to refresh your session.');
        }

        $stock = Stock::where('id', '=', $input['sid'])->first();
        if (!$stock)
            abort(400);

        // ensure they have bought the item
        $hasBoughtItem = false;
        $reviewLeft = Review::where('sid', '=', $input['sid'])->where('aid', '=', $userId)->first();

        if ($reviewLeft) {
            return back()->withInput()->withErrors('submit', 'You have already left a review on this item!');
        }

        $orders = Order::where('user_id', '=', $userId)->get();
        foreach($orders as $order) {
            foreach($order->items as $item) {
                if ($item->product_id == $stock->id && $item->status == 1 && $order->status == 3) {
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
        $review->sid = $stock->id;
        $review->rating = $input['rating'];
        $review->title = $input['title'];
        $review->content = $input['content'];
        $review->save();

        return redirect('/shop/' . $stock->id)->with("review_success", "Your review has been submitted. Thank you!");
    }

    public function edit(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'rid' => 'required|integer',
            'title' => 'required|string',
            'content' => 'required|string',
            'reason' => 'required|string',
        ]);

        $user = Account::where('aid', '=', $request->session()->get('id'))->first();
        if (!$user)
            abort(401);
        if ($user->isAdmin == 0)
            abort(403);

        $review = Review::where('rid', '=', $input['rid'])->first();
        if (!$review)
            abort(400);

        $review->edited = 1;
        $review->edited_by = $user->aid;
        $review->edited_reason = $input['reason'];
        $review->title = $input['title'];
        $review->content = $input['content'];
        $review->save();

        return redirect('/shop/' . $review->sid)->with("review_success", "Review has been edited successfully.");
    }

    public function delete(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'rid' => 'required|integer',
            'reason' => 'required|string',
        ]);

        $user = Account::where('aid', '=', $request->session()->get('id'))->first();
        if (!$user)
            abort(401);
        if ($user->isAdmin == 0)
            abort(403);

        $review = Review::where('rid', '=', $input['rid'])->first();
        if (!$review)
            abort(400);

        $review->deleted = 1;
        $review->deleted_by = $user->aid;
        $review->deleted_reason = $input['reason'];
        $review->save();

        return redirect('/shop/' . $review->sid)->with("review_success", "Review has been deleted successfully.");
    }

    public function restore(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'rid' => 'required|integer',
        ]);

        $user = Account::where('aid', '=', $request->session()->get('id'))->first();
        if (!$user)
            abort(401);
        if ($user->isAdmin == 0)
            abort(403);

        $review = Review::where('rid', '=', $input['rid'])->first();
        if (!$review)
            abort(400);

        $review->deleted = 0;
        $review->deleted_by = $user->aid;
        $review->deleted_reason = "Review restored.";
        $review->save();

        return redirect('/shop/' . $review->sid)->with("review_success", "Review has been restored successfully.");
    }
}
