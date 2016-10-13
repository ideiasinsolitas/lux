<?php

namespace App\DAL\Common\Properties;

trait LanguageTrait
{
    protected $language;

    public function setLanguage($value)
    {
        $this->language = $this->checkValueType($value, 'string');
    }

    public function getLanguage()
    {
        return $this->language;
    }
}
