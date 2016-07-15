<?php

namespace App\Http\Middleware;

class RestProcessorMiddleware
{
    public function handle($request, \Closure $next)
    {
        return $next(\App\Services\Rest\RequestResolver::resolve($request));
    }
}
