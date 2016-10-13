<<<<<<< HEAD
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
=======
<?php

namespace App\Providers;
>>>>>>> develop

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
=======
>>>>>>> develop
        'App\Events\Core\UserLoggedIn' => [
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserLoggedOut' => [
            'App\Listeners\Logger',
            'App\Listeners\SaveCart',
        ],
        'App\Events\Core\UserRegistered' => [
            'App\Listeners\Postman',
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserForgotPassword' => [
            'App\Listeners\Postman',
            'App\Listeners\Notification',
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserPasswordChanged' => [
<<<<<<< HEAD
            'App\Listeners\PostmanListener',
        ]
<<<<<<< HEAD
=======
        /**
         * Auth Events
         */
        'App\Events\Front\Auth\UserLoggedIn' => [
            'App\Listeners\Front\Auth\UserAccessHandler',
=======
            'App\Listeners\Notification',
            'App\Listeners\Logger',
        ],
        'App\Events\Core\UserAccountConfirmed' => [
            'App\Listeners\Notification',
            'App\Listeners\Logger',
        ],

        'App\Events\Business\UserAddedToProject' => [
            'App\Listeners\Notification',
            'App\Listeners\Logger',
        ],

        'App\Events\Business\TicketCreated' => [
            'App\Listeners\Notification',
            'App\Listeners\Logger',
        ],

        'App\Events\Business\TicketCommented' => [
            'App\Listeners\Notification',
            'App\Listeners\Logger',
        ],

        'App\Events\Business\OrderCreated' => [
            'App\Listeners\Notification',
            'App\Listeners\Logger',
>>>>>>> develop
        ],

        'App\Events\Business\InvoiceSent' => [
            'App\Listeners\Postman',
            'App\Listeners\Notification',
            'App\Listeners\Logger'
        ],

        'App\Events\Business\PaymentReceived' => [
            'App\Listeners\Postman',
            'App\Listeners\Notification',
            'App\Listeners\Logger',
            'App\Listeners\Business\TakeFromStorage',
        ],

        'App\Events\Business\ShippingSent' => [
            'App\Listeners\Postman',
            'App\Listeners\Notification',
            'App\Listeners\Logger'
        ],

        'App\Events\Business\ShippingArrived' => [
            'App\Listeners\Postman',
            'App\Listeners\Notification',
            'App\Listeners\Logger'
        ],

        'App\Events\Business\CustomerFeedback' => [
            'App\Listeners\Logger',
            'App\Listeners\Business\FeedbackHandler',
        ],
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
=======
>>>>>>> develop
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
