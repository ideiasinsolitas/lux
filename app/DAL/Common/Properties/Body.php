<?php

namespace App\DAL\Common\Properties;

trait Body
{
    protected $body;

    public function setBody($value)
    {
        $this->body = $this->checkValueType($value, 'string');
    }

    public function getBody()
    {
        return $this->body;
    }
}
