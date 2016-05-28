<?php

namespace App\Events\Core;

class UserForgotPassword
{
    use UserEventTrait;

    public function getTemplate()
    {
        return 'emails.resetpassword';
    }
}
