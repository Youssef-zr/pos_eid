<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
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
        $response = $next($request);

        //If the status is not approved redirect to login
        if (Auth::check() && Auth::user()->status != 'enabled') {
            Auth::logout();
            return redirect('/login')->with('userStatus', trans("lang.disabledAccount"));
        }

        return $next($request);
    }
}
