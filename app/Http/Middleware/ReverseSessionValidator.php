<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ReverseSessionValidator
{
    /**
     * This middleware checks to ensure a user is NOT logged in
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($request->session()->has('id'))
            return redirect('/'); // Proper messaging will come at a later stage, awaiting the front-end.

        return $next($request);
    }
}
