<?php

namespace App\Http\Middleware;

use App\Business;
use Closure;
use Illuminate\Support\Facades\Auth;

class CheckIsBusinessOwner
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

            }

            if(!empty($request->route()->parameter('business'))) {

                if($request->route()->parameter('business')->user_id == Auth::user()->id) {

                    return $next($request);

                }

            }

            return redirect()
                ->route('console.home')
                ->withErrors(['Sorry, you do not have access to that page.']);

        } else {

            return redirect()
                ->route('login')
                ->withErrors(['You must login before you can access that page.']);

        }

    }
}
