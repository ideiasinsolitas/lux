<?php

namespace App\Repositories\Publishing\ContentManagement\Relationships;

use App\Repositories\Common\Relationships;

trait PublisherRelationship
{
    use Relationships\Nodable,
        Relationships\Ownable,
        Relationships\Translatable;
}
