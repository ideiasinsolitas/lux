<?php

namespace App\Listeners;

class AuthListener
{
    public function handle($event)
    {
        \Log('handling Auth event');
        $user = $event->getUser();
    }
}
