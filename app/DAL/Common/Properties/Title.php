<?php

namespace App\DAL\Common\Properties;

trait TitleTrait
{
    protected $title;

    public function setTitle($value)
    {
        $this->title = $this->checkValueType($value, 'string');
    }

    public function getTitle()
    {
        return $this->title;
    }
}
