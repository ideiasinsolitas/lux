<?php

namespace App\Http\Middleware;

class CustomAuth
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
