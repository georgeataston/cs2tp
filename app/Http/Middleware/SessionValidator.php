<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SessionValidator
{
    /**
     * This middleware checks the user's session is valid and contains their ID.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('id'))
            return redirect('login'); // Proper messaging will come at a later stage, awaiting the front-end.

        return $next($request);
    }
}
