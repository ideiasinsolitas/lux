<?php

namespace App\DAL\Publishing\ContentManagement\Relationships;

use App\DAL\Common\Relationships;

trait PublicationRelationship
{
    use Relationships\Nodable,
        Relationships\Ownable,
        Relationships\OwnerTaggable,
        Relationships\Translatable;
}
