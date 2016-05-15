<?php

namespace App\Services\Sys;

class Config extends Facade
{
    public function getFacadeAccessor()
    {
        return 'config';
    }
}
