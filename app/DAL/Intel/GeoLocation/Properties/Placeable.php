<?php

namespace App\DAL\Intel\GeoLocation\Properties;

trait Placeable
{
    protected $place;

    public function setPlace($value)
    {
        $this->place = $this->createEntity($value, "\App\DAL\Intel\Geolocation\Place");
    }

    public function getPlace()
    {
        return $this->place;
    }
}
