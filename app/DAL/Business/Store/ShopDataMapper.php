<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Business\Store\Contracts\ShopDAOContract;
use App\DAL\Business\Store\Contracts\ProductDataMapperContract;

class ShopDataMapper extends AbstractDataMapper
{
    use DefaultDataMapperTrait;
    
    protected $dao;

    protected $products;

    public function __construct(ShopDAOContract $dao, ProductDataMapperContract $products)
    {
        $this->dao = $dao;
        $this->products = $products;
    }

    protected function saveRelationships($entity)
    {
        foreach ($entity->products->all() as $product) {
            $this->products->save($product);
        }
    }
}
