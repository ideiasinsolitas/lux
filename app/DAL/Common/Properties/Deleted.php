<?php

namespace App\DAL\Common\Properties;

trait Deleted
{
    protected $deleted;

    public function setDeleted($value)
    {
        $this->deleted = $this->checkDateValue($value);
    }

    public function getDeleted()
    {
        return $this->deleted;
    }
}
