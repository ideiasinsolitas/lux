<?php

namespace App\Events\Core;

trait UserEventTrait
{
    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
