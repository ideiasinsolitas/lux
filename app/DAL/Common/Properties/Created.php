<?php

namespace App\DAL\Common\Properties;

trait Created
{
    protected $created;

    public function setCreated($value)
    {
        $this->created = $this->checkDateValue($value);
    }

    public function getCreated()
    {
        return $this->created;
    }
}
