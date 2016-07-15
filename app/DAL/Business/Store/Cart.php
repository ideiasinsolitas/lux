<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractModel;

class Cart extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $customer_id;

    protected $product_id;

    protected $quantity;
}
