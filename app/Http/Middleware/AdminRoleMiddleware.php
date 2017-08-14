<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class AdminRoleMiddleware
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

        if( isset(Auth::user()->role_id) &&Auth::user()->role_id == 1 || isset(Auth::user()->role_id) && Auth::user()->role_id == 2){
            return $next($request);
        }
        else{
               return redirect()->route('home');
        }
    }
}
