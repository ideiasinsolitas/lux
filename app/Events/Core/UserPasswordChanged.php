<?php

namespace App\Events\Core;

class UserPasswordChanged
{
    use UserEventTrait;

    public function getTemplate()
    {
        return 'emails.passwordchanged';
    }
}
