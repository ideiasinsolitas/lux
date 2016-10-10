<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Notification extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable;
}
