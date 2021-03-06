<?php

namespace App\DAL\Core\Interaction\Relationships;

use App\DAL\Common\Relationships as CommonRelationships;

trait CommentRelationship
{
    use CommonRelationships\Nodable,
        CommonRelationships\Ownable;
}
