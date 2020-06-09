<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use const http\Client\Curl\AUTH_ANY;

class FrontMan
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
//        dd(Auth::guard('web'));
        if(Auth::check()){
            if(Auth::user()->isFrontMan() || Auth::user()->isAdmin()){
                return $next($request);

            }
        }

        return redirect('login');
    }
}
