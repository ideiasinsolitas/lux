<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;

class Product extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $store;

    protected $price;

    protected $weight;

    protected $height;

    protected $width;

    protected $depth;
}
