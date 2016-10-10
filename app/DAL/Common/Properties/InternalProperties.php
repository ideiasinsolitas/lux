<?php

namespace App\DAL\Common\Properties;

trait InternalProperties
{
    private $_state = "CLEAN";
    private $_allowed_states = ["CLEAN", "NEW", "DIRTY", "REMOVED"];

    public function setState($value)
    {
        if (in_array($value, $this->_allowed_states)) {
            $this->_state = $value;
        }
    }

    public function getState()
    {
        return $this->_state;
    }
}
