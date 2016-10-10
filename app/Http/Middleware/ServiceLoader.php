<?php

namespace App\Http\Middleware;

use App\Services\Sys\UserService;
use App\Services\Sys\ConfigService;
use App\Http\Requests\Generic\GenericRequest;
use Auth;

class ServiceLoader
{
    protected $configService;
    
    protected $userService;

    public function __construct(ConfigService $configService, UserService $userService)
    {
        $user = Auth::user();
        if (is_object($user) && isset($user->id)) {
            $configService->setUserId($user->id);
        }
        $this->configService = $configService->load();
        $this->userService = $userService;
    }

    public function handle(GenericRequest $request, \Closure $next)
    {
        $request->request->set('config', $this->configService->all());
        $request->request->set('user', $this->userService->all());
        return $next($request);
    }
}
