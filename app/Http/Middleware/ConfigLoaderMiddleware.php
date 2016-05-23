<?php

namespace App\Http\Middleware;

use App\Services\Sys\ConfigService;

class ConfigLoaderMiddleware
{
    protected $service;
    
    public function __construct(ConfigService $service)
    {
        $this->service = $service;
    }

    public function handle($request, Closure $next)
    {
        return $next($request);
    }
}
