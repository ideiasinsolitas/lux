<?php

namespace App\DAL\Common\Properties;

trait Username
{
    protected $username;

    public function setUsername($value)
    {
        $this->username = $this->checkValueType($value, 'string');
    }

    public function getUsername()
    {
        return $this->username;
    }
}
