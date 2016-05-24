<?php

namespace App\Repositories\Business\ProjectManagement\Relationships;

use App\Repositories\Common\Relationships;

trait ProjectRelationship
{
    use Relationships\Collaborative,
        Relationships\Ownable,
        Relationships\Nodable,
        Relationships\UserTaggable;
}
