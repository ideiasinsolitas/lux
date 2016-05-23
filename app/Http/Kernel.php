<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel
 * @package App\Http
 */
class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
<<<<<<< HEAD
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\LocaleMiddleware::class,
=======
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\ConfigLoaderMiddleware::class,
//        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
//        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        \App\Http\Middleware\VerifyCsrfToken::class,
//        \App\Http\Middleware\LocaleMiddleware::class,
//        \App\Http\Middleware\CustomAuthMiddleware::class,
>>>>>>> core-develop
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
<<<<<<< HEAD
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
=======
>>>>>>> core-develop

        /**
         * Access Middleware
         */
<<<<<<< HEAD
        'access.routeNeedsRole' => \App\Http\Middleware\RouteNeedsRole::class,
        'access.routeNeedsPermission' => \App\Http\Middleware\RouteNeedsPermission::class,
=======
>>>>>>> core-develop
    ];
}
