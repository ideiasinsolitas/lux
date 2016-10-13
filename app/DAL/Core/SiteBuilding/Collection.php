<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\Common\Properties;

class Collection extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Collectable,
        Properties\Typable,
        Properties\Index,
        Properties\Classname,
        Properties\Activity,
        Properties\Created,
        Properties\Modified,
        Properties\Deleted;
}
