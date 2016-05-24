<?php namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel
 * @package App\Http
 */
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
class Kernel extends HttpKernel
{

    /**
     * The application's global HTTP middleware stack.
     *
     * @var array
     */
    protected $middleware = [
<<<<<<< HEAD
=======
<<<<<<< HEAD
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\VerifyCsrfToken::class,
        \App\Http\Middleware\LocaleMiddleware::class,
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        \App\Http\Middleware\EncryptCookies::class,
        \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        \Illuminate\Session\Middleware\StartSession::class,
        \App\Http\Middleware\ConfigLoaderMiddleware::class,
//        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
//        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
//        \App\Http\Middleware\VerifyCsrfToken::class,
//        \App\Http\Middleware\LocaleMiddleware::class,
//        \App\Http\Middleware\CustomAuthMiddleware::class,
<<<<<<< HEAD
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
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
=======
<<<<<<< HEAD
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd

        /**
         * Access Middleware
         */
<<<<<<< HEAD
    ];
}
=======
class Kernel extends HttpKernel {

	/**
	 * The application's global HTTP middleware stack.
	 *
	 * @var array
	 */
	protected $middleware = [
		\Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
		\App\Http\Middleware\EncryptCookies::class,
		\Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
		\Illuminate\Session\Middleware\StartSession::class,
		\Illuminate\View\Middleware\ShareErrorsFromSession::class,
		\App\Http\Middleware\VerifyCsrfToken::class,
		\App\Http\Middleware\LocaleMiddleware::class,
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
		'auth' => \App\Http\Middleware\Authenticate::class,
		'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
		'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,

		/**
		 * Access Middleware
		 */
		'access.routeNeedsRole' => \App\Http\Middleware\RouteNeedsRole::class,
		'access.routeNeedsPermission' => \App\Http\Middleware\RouteNeedsPermission::class,
	];
}
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
<<<<<<< HEAD
        'access.routeNeedsRole' => \App\Http\Middleware\RouteNeedsRole::class,
        'access.routeNeedsPermission' => \App\Http\Middleware\RouteNeedsPermission::class,
=======
>>>>>>> core-develop
    ];
}
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
