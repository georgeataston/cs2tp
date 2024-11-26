<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /*
     * Creates a user account from a POST request.
     * Must contain the following string values:
     * - 'name'
     * - 'email'
     * - 'password'
     * - 'confirm_password'
     */
    public function create(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:accounts',
            'password' => 'required',
            'confirm_password' => 'required'
        ]);

        // Check if passwords match
        if ($input['password'] != $input['confirm_password']) {
            return back()->withErrors(['confirm_password' => 'Passwords do not match.'])->withInput();
        }

        // Create the account object
        $account = new Account;
        $account->name = $input['name'];
        $account->email = $input['email'];
        $account->password = Hash::make($input['password']);
        $account->save(); // save it to the DB.

        return redirect(); // redirect back to login page?
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
        return redirect('/'); // return to the home page
    }

    // Invalidate the session, "logging the user out".
    public function invalidateSession(Request $request): RedirectResponse
    {
        $request->session()->invalidate();

        return redirect('/');
    }
}
