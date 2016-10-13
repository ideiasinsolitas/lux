<?php

namespace App\DAL\Common\Properties;

trait Collector
{
    protected $collections;

    public function setCollections($value)
    {
        $this->collections = $this->createEntityCollection($value);
    }

    public function getCollections()
    {
        return $this->collections;
    }
}
