<?php

namespace App\DAL\Common\Properties;

trait DateReferenced
{
    protected $date_referenced;

    public function setDateReferenced($value)
    {
        $this->date_referenced = $this->checkDateValue($value);
    }

    public function getDateReferenced()
    {
        return $this->date_referenced;
    }
}
