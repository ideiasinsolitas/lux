<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class User extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Username,
        Properties\Email,
        Properties\Activity,
        Properties\Created,
        Properties\Modified,
        Properties\Deleted;

    protected $fist_name;
    protected $middle_name;
    protected $last_name;
    protected $display_name;
    protected $password;

    public function setFirstName($value)
    {
        $this->first_name = $this->checkValueType($value, "string");
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setMiddle($value)
    {
        $this->middle_name = $this->checkValueType($value, "string");
    }

    public function getMiddle()
    {
        return $this->middle_name;
    }

    public function setLastName($value)
    {
        $this->last_name = $this->checkValueType($value, "string");
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setDisplayName($value)
    {
        $this->display_name = $this->checkValueType($value, "string");
    }

    public function getDisplayName()
    {
        return $this->display_name;
    }

    public function setPassword($value)
    {
        $this->password = $this->checkValueType($value, "string");
    }

    public function getPassword()
    {
        return $this->password;
    }
}
