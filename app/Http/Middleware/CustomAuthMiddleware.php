<?php

namespace App\Http\Middleware;

class CustomAuthMiddleware
{
    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
