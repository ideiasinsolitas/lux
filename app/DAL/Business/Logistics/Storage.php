<?php

namespace App\DAL\Business\Logistics;

use App\DAL\AbstractModel;

class Storage extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $place_id;

    protected $name;

    protected $description;
}
