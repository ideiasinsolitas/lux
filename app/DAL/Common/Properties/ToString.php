<?php

namespace App\DAL\Common\Properties;

trait ToString
{
    public function __toString()
    {
        return (string) $this->toJson();
    }
}
