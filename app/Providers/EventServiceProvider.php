<?php

namespace App\Providers;

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
