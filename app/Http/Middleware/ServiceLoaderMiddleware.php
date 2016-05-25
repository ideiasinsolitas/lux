<?php

namespace App\Http\Middleware;

use App\Services\Sys\ConfigService;
use App\Http\Requests\Generic\GenericRequest;
use Auth;

class ServiceLoaderMiddleware
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

    public function handle(GenericRequest $request, \Closure $next)
    {
        $request->addService('config', $this->configService);
        return $next($request);
    }
}
