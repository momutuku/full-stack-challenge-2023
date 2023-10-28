<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Supervisor
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
        if (!Auth::check()) {
            return redirect('/home');
        }
        if (Auth::user()->role == 'supervisor' || Auth::user()->role == 'admin') {
            return $next($request);
           
        }else {
            return redirect('/home');
        }
    }
}
