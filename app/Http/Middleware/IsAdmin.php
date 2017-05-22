<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
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
        if(auth()->check() && auth()->user()->level <= 1) {
            return $next($request);
        } else if (auth()->check()) {
            return back()->with('flash_message', 'You are not authorized to view admin pages.');
        } else {
            return redirect()->guest('/login')->with('flash_message', 'Please log in with admin access to view this page');
        }

    }
}
