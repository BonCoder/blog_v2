<?php

namespace App\Http\Middleware;

use Closure;

class Entrance
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
        $ip = $request->ip();
        print_r($ip);die();

        return $next($request);
    }
}
