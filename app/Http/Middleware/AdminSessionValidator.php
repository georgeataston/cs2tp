<?php

namespace App\Http\Middleware;

use App\Models\Account;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminSessionValidator
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        return $next($request); // temp disable admin block
        
        if (!$request->session()->has('id'))
            return redirect('login'); // Proper messaging will come at a later stage, awaiting the front-end.
        else {
            $account = Account::where('aid', '=', $request->session()->get('id'))->first();
            if ($account == null)
                abort(401);

            if (!$account->isAdmin)
                abort(403);
        }

        return $next($request);
    }
}
