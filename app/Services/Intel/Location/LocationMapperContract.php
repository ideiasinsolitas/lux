<?php

namespace App\Services\Intel\Location;

interface LocationMapperContract
{
    public function getStreet();

    public function getNumber();

    public function getDistrict();

    public function getCity();

    public function getProvince();

    public function getCountry();

    public function getZipcode();
}
