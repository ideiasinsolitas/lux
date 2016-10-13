<?php

namespace App\DAL\Business\Store\Relationships;

use App\DAL\Common\Relationships;

trait ProductRelationship
{
    use Relationships\Collectable,
        Relationships\Likeable,
        Relationships\Votable,
        Relationships\Ownable,
        Relationships\OwnerTaggable,
        Relationships\Nodable;
}
