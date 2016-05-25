<?php

namespace App\Http\Middleware;

use App\Services\Sys\ConfigService;

use Auth;

class ConfigLoaderMiddleware
{
    protected $configService;
    
    public function __construct(ConfigService $configService)
    {
        $user = Auth::user();
        if ($user) {
            $configService->setUserId($user->id);
        }
        $this->configService = $configService->load();
    }

    public function handle($request, \Closure $next)
    {
        return $next($request);
    }
}
