<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\SiteBuilding\Contracts\NodeDAOContract;
use App\DAL\Core\SiteBuilding\Contracts\NodeDataMapperContract;

class NodeDataMapper extends AbstractDataMapper implements NodeDataMapperContract
{
    const ENTITY_CLASS = "App\DAL\Core\SiteBuilding\Node";
    
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(NodeDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
