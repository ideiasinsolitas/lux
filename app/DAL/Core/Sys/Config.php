<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Config extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable;

    protected $user;
    protected $key;
    protected $value;
    protected $format;

    public function setUser($value)
    {
        $this->user = $this->createEntity($value, "\\App\\DAL\\Core\\Sys\\User");
    }

    public function getUser()
    {
        return $this->user;
    }

    public function setKey($value)
    {
        $this->key = $this->checkValueType($value, "string");
    }

    public function getKey()
    {
        return $this->key;
    }

    public function setValue($value)
    {
        $this->value = $this->checkValueType($value, "string");
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setFormat($value)
    {
        $this->format = $this->checkValueType($value, "string");
    }

    public function getFormat()
    {
        return $this->format;
    }
}
