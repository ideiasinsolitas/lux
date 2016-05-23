<?php

namespace App\Listeners\Core\Sys;

use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use App\Events\Core\Sys\LogEvent;

/**
 * Class UserLoggedInHandler
 * @package App\Listeners\Front\Auth
 */
class LogHandler implements ShouldQueue
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
        \Log::info("User Logged Out: ". $event->name);
    }
}
