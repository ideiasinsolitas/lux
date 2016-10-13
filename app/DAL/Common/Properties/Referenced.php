<?php

namespace App\DAL\Common\Properties;

trait Referenced
{
    protected $referenced;

    public function setDateReferenced($value)
    {
        $this->referenced = $this->checkDateValue($value);
    }

    public function getDateReferenced()
    {
        return $this->referenced;
    }
}
