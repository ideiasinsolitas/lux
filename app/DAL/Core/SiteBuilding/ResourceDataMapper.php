<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\SiteBuilding\Contracts\ResourceDAOContract;
use App\DAL\Core\SiteBuilding\Contracts\ResourceDataMapperContract;

class ResourceDataMapper extends AbstractDataMapper implements ResourceDataMapperContract
{
    const ENTITY_CLASS = "App\DAL\Core\SiteBuilding\Resource";
    
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(ResourceDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
