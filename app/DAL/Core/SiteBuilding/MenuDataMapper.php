<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\SiteBuilding\Contracts\MenuDAOContract;
use App\DAL\Core\SiteBuilding\Contracts\MenuDataMapperContract;

class MenuDataMapper extends AbstractDataMapper implements MenuDataMapperContract
{
    const ENTITY_CLASS = "App\DAL\Core\SiteBuilding\Menu";
    
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(
        MenuDAOContract $dao
    ) {
        $this->dao = $dao;
    }
}
