<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class Admin
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
        if( Auth::check() && Auth::user()->type!="admin" ){
            return redirect('/create');  
        } else if(Auth::guest()){
            return redirect('/login');
        }
        return $next($request);
    }
}
