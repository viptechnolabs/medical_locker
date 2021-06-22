<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CheckStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::guard('hospital')->check()) {
            //dd('here');
            return $next($request);
        }
        elseif (Auth::guard('doctor')->check())
        {
            if (Auth::guard('doctor')->user()->status === 'active')
            {
                return $next($request);
            }
            else
            {
                Session::flush();
                Auth::logout();
                return redirect()
                ->route('login')
                ->with('error','You are logout...!');
            }
        }
        elseif (Auth::guard('web')->check())
        {
            if (Auth::guard('web')->user()->status === 'active')
            {
                return $next($request);
            }
            else
            {
                Session::flush();
                Auth::logout();
                return redirect()
                    ->route('login')
                    ->with('error','You are logout...!');
            }

        }

    }
}
