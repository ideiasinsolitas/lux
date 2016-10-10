<?php

namespace App\DAL\Common\Properties;

trait Indexable
{
    protected $index;

    public function setIndex($value)
    {
        $this->index = $this->checkValueType($value, 'integer');
    }

    public function getIndex()
    {
        return $this->index;
    }
}
