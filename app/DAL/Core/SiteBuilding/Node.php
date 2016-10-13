<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Node extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Hierarchical,
        Properties\Activity,
        Properties\Created,
        Properties\Modified,
        Properties\Deleted;
}
