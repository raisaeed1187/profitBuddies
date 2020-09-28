<?php

namespace App\Http\Middleware;

use Closure;
 
class firebase
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
        if(\Session::has('uid'))
            return $next($request);
        else
            return redirect('/signInForm');
    }
}
