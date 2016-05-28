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
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserLoggedOut' => [
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserRegistered' => [
            'App\Listeners\Postman',
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserForgotPassword' => [
            'App\Listeners\Postman',
        ],
        'App\Events\Core\UserPasswordChanged' => [
            'App\Listeners\Notification',
        ],
        'App\Events\Core\UserAccountConfirmed' => [
            'App\Listeners\Notification',
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
