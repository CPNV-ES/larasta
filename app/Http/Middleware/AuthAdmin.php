<?php

namespace App\Http\Middleware;

use Closure;
// Intranet env
use CPNVEnvironment\Environment;

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
        if (Environment::currentUser()->getLevel() >= 2){
            return response(view('admin/menu'));
        }else{
            return redirect('/');
        }
        return $next($request);
    }
}
