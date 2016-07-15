<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractModel;

class Product extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $node_id;

    protected $store_id;

    protected $in_stock;

    protected $price;

    protected $weight;

    protected $height;

    protected $width;

    protected $depth;

    protected $activity;

    protected $created;

    protected $modified;

    protected $deleted;
}
