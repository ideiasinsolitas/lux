<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\ServiceLoader::class,
        \App\Http\Middleware\FilterMiddleware::class,
        \App\Http\Middleware\RestProcessorMiddleware::class,
        \App\Http\Middleware\RestResponseMiddleware::class,
        
//        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
//        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        \App\Http\Middleware\VerifyCsrfToken::class,
//        \App\Http\Middleware\LocaleMiddleware::class,
//        \App\Http\Middleware\CustomAuthMiddleware::class,
    ];

    /**
     * The application's route middleware.
     *
     * @var array
     */
    protected $routeMiddleware = [
        /**
         * Default laravel route middleware
         */

        /**
         * Access Middleware
         */
    ];
}
