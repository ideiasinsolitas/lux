<?php

namespace App\DAL;

use App\DAL\System\User;

trait UserEntityTrait
{
    protected $user;

    public function getUser()
    {
        return isset($this->user) ? $this->user : new User();
    }

    public function setUser($user)
    {
        if ($user instanceof User) {
            $this->user = $user;
        } elseif (is_array($user) || $user instanceof \stdClass) {
            $this->user = User::hydrate();
        } elseif (is_int((int) $user)) {
            $this->user = $this->getUser();
            $this->user->id = $user;
        } else {
            throw new \Exception("Error Processing Request", 1);
        }
    }
}
