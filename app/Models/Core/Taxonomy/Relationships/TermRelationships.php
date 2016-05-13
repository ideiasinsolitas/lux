<?php

namespace App\Models\Core\Taxonomy\Relationships;

use App\Models\Common\Relationships as CommonRelationships;

trait TermRelationship
{
    use CommonRelationships\Nodable,
        CommonRelationships\Translatable;
}
