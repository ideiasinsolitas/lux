<?php

namespace App\DAL\Common\Properties;

use App\DAL\Exceptions\EntityTypeCheckException;

trait Typable
{
    protected $type;

    public function setType($value)
    {
        $this->type = $this->createEntity($value, "\App\DAL\Core\Sys\Type");
    }

    public function getType()
    {
        return $this->type || new \App\DAL\Core\Sys\Type();
    }
}
