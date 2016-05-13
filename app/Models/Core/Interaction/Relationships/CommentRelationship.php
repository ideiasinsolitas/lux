<?php

namespace App\Models\Core\Interaction\Relationships;

use App\Models\Common\Relationships as CommonRelationships;

trait CommentRelationship
{
    use CommonRelationships\Translatable,
        CommonRelationships\Ownable;
}
