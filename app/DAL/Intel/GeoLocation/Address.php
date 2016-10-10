<?php

namespace App\DAL\Intel\GeoLocation;

use App\DAL\AbstractEntity;

class Address extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $street;

    protected $number;

    protected $district;

    protected $city;

    protected $province;

    protected $region;

    protected $country;

    protected $zipcode;

    protected $coordinate;

    public function setStreet($value)
    {
        $this->street = $this->checkValueType($value, 'string');
    }

    public function getStreet()
    {
        return $this->street;
    }

    public function setNumber($value)
    {
        $this->number = $this->checkValueType($value, 'string');
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function setDistrict($value)
    {
        $this->district = $this->checkValueType($value, 'string');
    }

    public function getDistrict()
    {
        return $this->district;
    }

    public function setCity($value)
    {
        $this->city = $this->checkValueType($value, 'string');
    }

    public function getCity()
    {
        return $this->city;
    }

    public function setProvince($value)
    {
        $this->province = $this->checkValueType($value, 'string');
    }

    public function getProvince()
    {
        return $this->province;
    }

    public function setRegion($value)
    {
        $this->region = $this->checkValueType($value, 'string');
    }

    public function getRegion()
    {
        return $this->region;
    }

    public function setCountry($value)
    {
        $this->country = $this->checkValueType($value, 'string');
    }

    public function getCountry()
    {
        return $this->country;
    }

    public function setZipcode($value)
    {
        $this->zipcode = $this->checkValueType($value, 'string');
    }

    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function setCoordinate($value)
    {
        $this->coordinate = $this->createEntity($value, "\\App\\DAL\\Intel\\GeoLocation\\Coordinate");
    }

    public function getCoordinate()
    {
        return $this->coordinate;
    }
}
