<?php

namespace App\Listeners;

class PostmanListener
{
    /**
     * Handle the event.
     *
     * @param  UserLoggedIn  $event
     * @return void
     */
    public function handle($event)
    {
        \Log::info();
    }
}
