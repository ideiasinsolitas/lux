<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

trait RequestTrait
{
    protected $services = array();

    public function addService($name, $service)
    {
        session()->set('service.' . $name, $service);
    }

    public function getService($name)
    {
        return session()->get('service.' . $name);
    }
}
