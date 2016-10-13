<?php

namespace App\DAL\Intel\GeoLocation;

use App\DAL\AbstractEntity;

class Place extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $address;

    protected $address_line;

    public function setAddress($value)
    {
        $this->address = $this->createEntity($value, "\App\DAL\Intel\Geolocation\Address");
    }

    public function getAddress()
    {
        return $this->address;
    }

    public function setAddressLine($value)
    {
        $this->address_line = $this->checkValueType($value, "string");
    }

    public function getAddressLine()
    {
        return $this->address_line;
    }
}
