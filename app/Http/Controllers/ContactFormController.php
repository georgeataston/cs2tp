<?php

namespace App\Http\Controllers;

use App\Models\ContactFormEntry;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ContactFormController extends Controller
{
    /*
     * Creates a contact entry from a POST request.
     * Must contain the following string values:
     * - 'name'
     * - 'email'
     * - 'message'
    */
    public function create(Request $request): RedirectResponse
    {
        // Validate user input, check for required values
        // and sanitise the input
        $input = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Create the account object
        $entry = new ContactFormEntry;
        $entry->name = $input['name'];
        $entry->email = $input['email'];
        $entry->message = $input['message'];
        $entry->save();

        return redirect("/contact")->with("success", "true");
    }
}
