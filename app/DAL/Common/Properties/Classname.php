<?php

namespace App\DAL\Common\Properties;

trait Classname
{
    protected $class;

    public function setClass($value)
    {
        $this->class = $this->checkType($value, "string");
    }

    public function getClass()
    {
        return $this->class;
    }
}
