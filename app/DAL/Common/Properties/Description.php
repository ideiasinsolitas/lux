<?php

namespace App\DAL\Common\Properties;

trait Description
{
    protected $description;

    public function setDescription($value)
    {
        $this->description = $value;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
