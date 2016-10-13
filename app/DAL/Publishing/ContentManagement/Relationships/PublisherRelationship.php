<?php

namespace App\DAL\Publishing\ContentManagement\Relationships;

use App\DAL\Common\Relationships;

trait PublisherRelationship
{
    use Relationships\Nodable,
        Relationships\Ownable,
        Relationships\Translatable;
}
