<?php

namespace App\DAL\Business\ProjectManagement\Relationships;

use App\DAL\Common\Relationships;

trait ProjectRelationship
{
    use Relationships\Collaborative,
        Relationships\Ownable,
        Relationships\Nodable,
        Relationships\UserTaggable;
}
