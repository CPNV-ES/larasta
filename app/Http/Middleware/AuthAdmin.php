<?php

namespace App\Http\Middleware;

use Closure;
// Intranet env
use CPNVEnvironment\Environment;
use Illuminate\Support\Facades\Auth;

class AuthAdmin
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
        if (Auth::user()->role > 1){
            //continue and use the controller
            return $next($request);
        }else{
            //redirect and initialize a flash session data
            return redirect('/')->with('error','You don\'t have admin access');;
        }
    }
}
