<?php
namespace App\Listeners\Front\Auth;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Front\Auth\UserLoggedIn;
use App\Events\Front\Auth\UserLoggedOut;

/**
 * Class UserLoggedInHandler
 * @package App\Listeners\Front\Auth
 */
class UserAccessHandler implements ShouldQueue
{

    use InteractsWithQueue;

    /**
     * Create the event handler.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle($event)
    {
        if ($event instanceof UserLoggedIn) {
            \Log::info("User Logged In: ".$event->user->name);
        } elseif ($event instanceof UserLoggedIn) {
            \Log::info("User Logged Out: ".$event->user->name);
        }
    }
}
