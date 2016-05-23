<<<<<<< HEAD
<?php namespace App\Providers;
=======
<?php

namespace App\Providers;
>>>>>>> core-develop

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
>>>>>>> core-develop
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
