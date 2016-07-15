<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractModel;

class Shop extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $node_id;

    protected $seller_id;

    protected $name;

    protected $description;
}
