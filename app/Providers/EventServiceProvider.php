<<<<<<< HEAD
<<<<<<< HEAD
<?php

namespace App\Providers;
=======
<?php namespace App\Providers;
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
<?php namespace App\Providers;
=======
<?php

namespace App\Providers;
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd

use Illuminate\Contracts\Events\Dispatcher as DispatcherContract;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

/**
 * Class EventServiceProvider
 * @package App\Providers
 */
class EventServiceProvider extends ServiceProvider
{

    /**
     * The event handler mappings for the application.
     *
     * @var array
     */
    protected $listen = [
<<<<<<< HEAD
<<<<<<< HEAD
=======
        /**
         * Auth Events
         */
        'App\Events\Front\Auth\UserLoggedIn' => [
            'App\Listeners\Front\Auth\UserAccessHandler',
        ],
        'App\Events\Front\Auth\UserLoggedOut' => [
            'App\Listeners\Front\Auth\UserAccessHandler',
        ],
        /**
         * Sys Events
         */
        'App\Events\Core\Sys\LogEvent' => [
            'App\Listeners\Core\Sys\LogHandler',
        ],
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        'App\Events\Core\UserLoggedIn' => [
            'App\Listeners\LoggerListener',
        ],
        'App\Events\Core\UserLoggedOut' => [
            'App\Listeners\LoggerListener',
        ],
        'App\Events\Core\UserRegistered' => [
            'App\Listeners\PostmanListener',
            'App\Listeners\NotificationListener',
            'App\Listeners\LoggerListener',
        ],
        'App\Events\Core\UserForgotPassword' => [
            'App\Listeners\NotificationListener',
        ],
        'App\Events\Core\UserPasswordChanged' => [
            'App\Listeners\PostmanListener',
        ]
<<<<<<< HEAD
=======
        /**
         * Auth Events
         */
        'App\Events\Front\Auth\UserLoggedIn' => [
            'App\Listeners\Front\Auth\UserAccessHandler',
        ],
        'App\Events\Front\Auth\UserLoggedOut' => [
            'App\Listeners\Front\Auth\UserAccessHandler',
        ],
        /**
         * Sys Events
         */
        'App\Events\Core\Sys\LogEvent' => [
            'App\Listeners\Core\Sys\LogHandler',
        ],
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    ];

    /**
     * Register any other events for your application.
     *
     * @param  \Illuminate\Contracts\Events\Dispatcher  $events
     * @return void
     */
    public function boot(DispatcherContract $events)
    {
        parent::boot($events);
    }
}
