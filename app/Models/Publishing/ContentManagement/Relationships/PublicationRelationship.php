<?php

namespace App\Repositories\Publishing\ContentManagement\Relationships;

use App\Repositories\Common\Relationships;

trait PublicationRelationship
{
    use Relationships\Nodable,
        Relationships\Ownable,
        Relationships\OwnerTaggable,
        Relationships\Translatable;
}
