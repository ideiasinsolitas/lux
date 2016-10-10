<?php

namespace App\DAL\Common\Properties;

trait DatePublished
{
    protected $date_published;

    public function setDatePublished($value)
    {
        $this->date_published = $this->checkDateValue($value);
    }

    public function getDatePublished()
    {
        return $this->date_published;
    }
}
