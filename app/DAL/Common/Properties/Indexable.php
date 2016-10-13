<?php

namespace App\DAL\Common\Properties;

trait Indexable
{
    protected $position;

    public function setIndex($value)
    {
        $this->position = $this->checkValueType($value, 'integer');
    }

    public function getIndex()
    {
        return $this->position;
    }
}
