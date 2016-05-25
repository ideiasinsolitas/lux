<?php

namespace App\Http\Requests\Generic;

use App\Http\Requests\Request;

class GenericRequest extends Request
{
    protected $services = array();

    public function setServices(array $services)
    {
        $this->services = $services;
    }

    public function addService($name, $service)
    {
        $this->services[$name] = $service;
    }
}
