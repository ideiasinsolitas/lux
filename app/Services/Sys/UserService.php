<?php

namespace App\Services\Sys;

use App\DAL\Core\Sys\Contracts\UserDataMapperContract;

class UserService
{
    protected $data;
    protected $users;

    public function __construct(UserDataMapperContract $users)
    {
        $this->users = $users;
    }

    public function load()
    {
        if (!\Auth::user()) {
            $this->data = ['display_name' => 'Guest'];
        } else {
            $this->data = $this->users->fetchById(\Auth::user()->id);
        }
        return $this;
    }

    public function all()
    {
        return $this->data;
    }

    public function get($key)
    {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }
}
