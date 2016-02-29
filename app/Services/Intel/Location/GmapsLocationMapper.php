<?php

namespace App\Services\Intel;

class GmapsLocationMapper implements LocationMapperContract
{
    use GmapsMapper;

    protected $location;

    public function setLocation($location)
    {
        $this->location = $location;
        return $this;
    }

    public function mapToArray($location)
    {
        $this->setLocation($location);
        return [
            'street' => $this->getStreet(),
            'number' => $this->getNumber(),
            'district' => $this->getDistrict(),
            'city' => $this->getCity(),
            'province' => $this->getProvince(),
            'country' => $this->getCountry(),
            'zipcode' => $this->getZipcode()
        ];
    }
}
