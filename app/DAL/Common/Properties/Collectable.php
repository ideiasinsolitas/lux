<?php

namespace App\DAL\Common\Properties;

trait Collectable
{
    protected $collector;

    public function setCollector($value)
    {
        $this->collector = $value;
    }

    public function getCollector()
    {
        return $this->collector;
    }
}
