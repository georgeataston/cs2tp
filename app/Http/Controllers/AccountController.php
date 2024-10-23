<?php

namespace App\Http\Controllers;

use App\Models\Account;
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

        return redirect();
    }
}
