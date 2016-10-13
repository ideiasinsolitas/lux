<?php

namespace App\DAL\Publishing\ContentManagement\Relationships;

use App\DAL\Common\Relationships;

trait ContentRelationship
{
    use Relationships\Collaborative,
        Relationships\Commentable,
        Relationships\Likeable,
        Relationships\Nodable,
        Relationships\UserTaggable,
        Relationships\Ownable,
//        Relationships\OwnerTaggable,
        Relationships\Votable,
        Relationships\Translatable,
        Relationships\Collector;
}
