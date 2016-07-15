<?php

namespace App\Http\Middleware;

use Closure;
use App\Services\Rest\RestProcessorContract;

class RestResponseMiddleware
{
    protected $rest;

    public function __construct(RestProcessorContract $rest)
    {
        $this->rest = $rest;
    }
    
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        return $this->rest->process($response);
    }
}
