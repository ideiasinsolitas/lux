<?php

namespace App\Events\Core;

class UserRegistered
{
    protected $user_id;

    public function __construct($user_id)
    {
        $this->user_id = $user_id;
    }
}
