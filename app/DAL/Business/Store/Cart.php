<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;

class Cart extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $customer;

    protected $product;

    protected $quantity;
}
