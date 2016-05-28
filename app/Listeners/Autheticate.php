<?php

namespace App\Listeners;

class AuthListener
{
    public function handle($event)
    {
        $user = $event->getUser();
    }
}
