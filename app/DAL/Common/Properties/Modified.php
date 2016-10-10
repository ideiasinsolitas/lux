<?php

namespace App\DAL\Common\Properties;

trait Modified
{
    protected $modified;

    public function setModified($value)
    {
        $this->modified = $this->checkDateValue($value);
    }

    public function getModified()
    {
        return $this->modified;
    }
}
