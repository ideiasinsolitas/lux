<?php

namespace App\DAL\Common\Properties;

trait Sluggable
{
    protected $slug;

    public function setSlug($value)
    {
        $this->slug = $this->checkValueType($value, 'string');
    }

    public function getSlug()
    {
        return $this->slug;
    }
}
