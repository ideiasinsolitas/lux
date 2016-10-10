<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractEntity;

class AuthUser extends AbstractEntity
{
    protected $email;

    protected $password;

    protected $remember_me;
}
