<?php

namespace App\DAL\Common\Properties;

trait Name
{
    protected $name;

    public function setName($value)
    {
        $this->name = $this->checkValueType($value, 'string');
    }

    public function getName()
    {
        return $this->name;
    }
}
