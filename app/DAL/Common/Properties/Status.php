<?php

namespace App\DAL\Common\Properties;

trait StatusTrait
{
    protected $status;

    public function setStatus($value)
    {
        $this->status = $this->checkValueType($value, 'string');
    }

    public function getStatus()
    {
        return $this->status;
    }
}
