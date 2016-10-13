<?php

namespace App\DAL\Common\Properties;

trait Email
{
    protected $email;

    public function setEmail($value)
    {
        $this->email = $this->checkValueType($value, 'string');
    }

    public function getEmail()
    {
        return $this->email;
    }
}
