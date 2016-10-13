<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Token extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\UserOwned,
        Properties\Name,
        Properties\Created;

    protected $used;

    protected $ip;

    protected $token;


    public function setUsed($value)
    {
        $this->used = $this->checkDate($value);
    }

    public function getUsed()
    {
        return $this->used;
    }

    public function setIp($value)
    {
        $this->ip = $this->checkValueType($value, "string");
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function setToken($value)
    {
        $this->token = $this->checkValueType($value, "string");
    }

    public function getToken()
    {
        return $this->token;
    }
}
