<?php

namespace App\DAL\Common\Properties;

trait Published
{
    protected $published;

    public function setDatePublished($value)
    {
        $this->published = $this->checkDateValue($value);
    }

    public function getDatePublished()
    {
        return $this->published;
    }
}
