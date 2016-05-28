<?php

namespace App\Events\Core;

class UserRegistered
{
    use UserEventTrait;

    public function getTemplate()
    {
        return 'emails.confirmation';
    }
}
