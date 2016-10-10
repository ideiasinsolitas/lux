<?php

namespace App\DAL\Business\Store;

use App\DAL\AbstractDataMapper;

class CustomerDataMapper extends AbstractDataMapper
{
    protected $dao;

    protected $carts;

    public function __construct(UserDAOContract $dao, CartDataMapperContract $carts)
    {
        $this->dao = $dao;
        $this->carts = $carts;
    }

    public function saveRelationships($entity)
    {
        $this->carts->save($entity->cart);
    }
}
