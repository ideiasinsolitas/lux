<?php

namespace App\DAL\Intel\RealEstate;

use App\DAL\AbstractEntity;

class Estate extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $area;
    protected $rooms;
    protected $suites;
    protected $parking_spots;
    protected $price;
    protected $charges;
    protected $taxes;
    protected $additional_info;

    public function setArea($value)
    {
        $this->area = $this->checkValueType($value, "integer");
    }

    public function getArea()
    {
        return $this->area;
    }

    public function setRooms($value)
    {
        $this->rooms = $this->checkValueType($value, "integer");
    }

    public function getRooms()
    {
        return $this->rooms;
    }

    public function setSuites($value)
    {
        $this->suites = $this->checkValueType($value, "integer");
    }

    public function getSuites()
    {
        return $this->suites;
    }

    public function setParkingSpots($value)
    {
        $this->parking_spots = $this->checkValueType($value, "integer");
    }

    public function getParkingSpots()
    {
        return $this->parking_spots;
    }

    public function setPrice($value)
    {
        $this->price = $this->checkValueType($value, "float");
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setCharges($value)
    {
        $this->charges = $this->checkValueType($value, "float");
    }

    public function getCharges()
    {
        return $this->charges;
    }

    public function setTaxes($value)
    {
        $this->taxes = $this->checkValueType($value, "float");
    }

    public function getTaxes()
    {
        return $this->taxes;
    }

    public function setAdditionalInfo($value)
    {
        $this->additional_info = $this->checkValueType($value, "string");
    }

    public function getAdditionalInfo()
    {
        return $this->additional_info;
    }
}
