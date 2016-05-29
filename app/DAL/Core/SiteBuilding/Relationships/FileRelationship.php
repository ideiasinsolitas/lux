<?php

namespace App\DAL\Core\SiteBuilding\Relationships;

use App\DAL\Common\Relationships as CommonRelationships;

trait FileRelationship
{
    use CommonRelationships\Ownable,
        CommonRelationships\Collectable;
}
