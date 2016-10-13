<?php

namespace App\Http\Middleware;

class FilterMiddleware
{
    public function handle($request, \Closure $next)
    {
        $filters = $request->only(['per_page', 'sort']);
        $request->request->set("filters", $filters);
        return $next($request);
    }
}
