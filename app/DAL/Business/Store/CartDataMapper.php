<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Business\Sales\Contracts\CartDAOContract;

class CartDataMapper extends AbstractDataMapper
{
    use DefaultDataMapperTrait;
    
    protected $dao;

    public function __construct(CartDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
