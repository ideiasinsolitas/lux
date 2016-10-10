<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Business\Sales\Contracts\ProductDAOContract;

class ProductDataMapper extends AbstractDataMapper
{
    use DefaultDataMapperTrait;

    public function __construct(ProductDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
