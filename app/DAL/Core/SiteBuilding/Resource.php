<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractEntity;

class Resource extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable;

    protected $embed;
    protected $url;

    public function setEmbed($value)
    {
        $this->embed = $this->checkValueType($value, 'string');
    }

    public function getEmbed()
    {
        return $this->embed;
    }

    public function setUrl($value)
    {
        $this->url = $this->checkValueType($value, 'string');
    }

    public function getUrl()
    {
        return $this->url;
    }
}
