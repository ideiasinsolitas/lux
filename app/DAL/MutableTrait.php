<?php

namespace App\DAL;

trait MutableTrait
{
    protected $_state = "CLEAN";

    public function setState($value)
    {
        $this->_state = $value;
    }

    public function getState()
    {
        return $this->_state;
    }
}
