<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\SiteBuilding\Contracts\CollectionDAOContract;
use App\DAL\Core\SiteBuilding\Contracts\CollectionDataMapperContract;

class CollectionDataMapper extends AbstractDataMapper implements CollectionDataMapperContract
{
    const ENTITY_CLASS = "App\DAL\Core\SiteBuilding\Collection";
    
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(
        CollectionDAOContract $dao
    ) {
        $this->dao = $dao;
    }
}
