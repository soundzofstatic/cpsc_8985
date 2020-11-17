<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIfAuthenticatedIsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        if(Auth::check()) {

            if(Auth::user()->isAdmin()) {

                return $next($request);

            } else {

                return redirect()
                    ->route('console.home')
                    ->withErrors(['Sorry, you do not have access to that page.']);

            }

        } else {

            return redirect()
                ->route('login')
                ->withErrors(['You must login before you can access that page.']);

        }
    }
}
