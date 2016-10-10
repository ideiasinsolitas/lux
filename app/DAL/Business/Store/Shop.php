<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;

class Shop extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $seller;
}
