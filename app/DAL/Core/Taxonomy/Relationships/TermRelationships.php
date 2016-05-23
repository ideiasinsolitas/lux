<?php

namespace App\DAL\Core\Taxonomy\Relationships;

use App\DAL\Common\Relationships as CommonRelationships;

trait TermRelationship
{
    use CommonRelationships\Nodable,
        CommonRelationships\Translatable;
}
