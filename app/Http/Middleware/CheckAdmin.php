<?php

namespace App\Http\Middleware;

use Closure;

class CheckAdmin
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
        if(auth()->user()->role == "Admin") {
            return $next($request);
        }
        else {
            return response()->json(["message" => "Unauthorized Access to API"], 401);
        }
    }
}
