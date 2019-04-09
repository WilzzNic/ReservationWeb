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
        $guard = Auth::guard($guard);
        if ($guard->check()) {
            if($guard->user()->role == 'Admin') {
                return redirect('admin/restaurants');
            } else if($guard->user()->role == 'Restaurant') {
                return redirect('restaurant/reservations');
            } else {
                return redirect('/');
            }
        }

        return $next($request);
    }
}
