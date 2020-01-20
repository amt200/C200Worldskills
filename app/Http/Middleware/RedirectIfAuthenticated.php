<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */

    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard == "organizer" && Auth::guard($guard)->check()) {
            return redirect('/dashboard');
        }
        if ($guard == "attendee" && Auth::guard($guard)->check()) {
            return redirect('/attendee');
        }
        if (Auth::guard($guard)->check()) {
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
