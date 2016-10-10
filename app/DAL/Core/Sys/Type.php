<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Type extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Name,
        Properties\Classname;
}
