<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\PasswordReset;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AccountController extends Controller
{
    /*
     * Creates a user account from a POST request.
     * Must contain the following string values:
     * - 'fName'
     * - 'email'
     * - 'password'
     * - 'confirm_password'
     */
    public function create(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'fName' => 'required',
            'email' => 'required|email|unique:accounts',
            'password' => 'required',
            'cPassword' => 'required'
        ]);

        // Check if passwords match
        if ($input['password'] != $input['cPassword']) {
            return back()->withErrors(['cPassword' => 'Passwords do not match.'])->withInput();
        }

        // Create the account object
        $account = new Account;
        $account->name = $input['fName'];
        $account->email = $input['email'];
        $account->password = Hash::make($input['password']);
        $account->save(); // save it to the DB.

        $request->session()->regenerate();
        $request->session()->put('id', $account->aid);
        return redirect('/account');
    }

    /**
     * Authenticates a user from their login POST request.
     * Must contain the following string values:
     * - 'email'
     * - 'password'
     */
    public function authenticate(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check if the user exists via their e-mail
        $user = Account::where('email', '=', $credentials['email'])->first();
        if (!$user) { // If not reject.
            return back()->withErrors(['login' => 'E-mail or password is incorrect'])->withInput();
        }

        // Check the passwords match
        if (!Hash::check($credentials['password'], $user->password)) { // If not reject
            return back()->withErrors(['login' => 'E-mail or password is incorrect'])->withInput();
        }

        // Create the user's session and put their account ID in it.
        $request->session()->regenerate();
        $request->session()->put('id', $user->aid);
        $request->session()->put('isAdmin', $user->isAdmin);
        return redirect('/account');
    }

    // Invalidate the session, "logging the user out".
    public function invalidateSession(Request $request): RedirectResponse
    {
        $cart = $request->session()->get('cart');
        $request->session()->invalidate();
        $request->session()->put('cart', $cart); // keeps the user's cart

        return redirect('/');
    }

    public function requestPasswordReset(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'email' => 'required|email',
        ]);

        $user = Account::where('email', '=', $credentials['email'])->first();
        if (!$user) {
            return redirect('recovery')->with("success", "true"); // just for security lol
        }

        $previousReset = PasswordReset::where('aid', '=', $user->aid)->first();
        if ($previousReset) {
            if (time() < $previousReset->allow_new_request) {
                return redirect('recovery')->with("success", "You already have an active request. Please allow up to 3 minutes to receive the e-mail. You may request a new reset after this time period has elapsed.");
            }
            $previousReset->delete();
        }


        $reset = new PasswordReset;
        $reset->aid = $user->aid;
        $reset->token = bin2hex(random_bytes(64 / 2));
        $reset->expiry = strtotime("+30 minutes", time());
        $reset->allow_new_request = strtotime("+3 minutes", time());
        $reset->save();

        Mail::to($user->email)->send(new \App\Mail\PasswordReset($user, $reset));

        return redirect('recovery')->with("success", "true");
    }

    public function forgottenPasswordReset(Request $request): RedirectResponse {
        $credentials = $request->validate([
            'password' => 'required',
            'repeat_password' => 'required',
            'token' => 'required',
        ]);

        if ($credentials['password'] != $credentials['repeat_password']) {
            return back()->withErrors(['submit' => 'Passwords do not match.']);
        }

        $reset = PasswordReset::where('token', '=', $credentials['token'])->first();
        if (!$reset) {
            return redirect('/recovery')->with('error', 'Request is invalid or has expired.');
        }

        if (time() > $reset->expiry) {
            $reset->delete();
            return redirect('/recovery')->with('error', 'Request is invalid or has expired.');
        }

        $account = $reset->account;
        $account->password = Hash::make($credentials['password']);
        $account->save();

        $reset->delete();

        return redirect('/login')->with('success', 'Password reset successfully.');
    }
}
