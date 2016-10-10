<?php

namespace App\DAL\Business\Logistics;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Storage extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Description,
        Properties\Name,
        \App\DAL\Intel\GeoLocation\Properties\Placeable;
}
