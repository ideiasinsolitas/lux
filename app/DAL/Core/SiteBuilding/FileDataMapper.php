<?php

namespace App\DAL\Core\SiteBuilding;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\SiteBuilding\Contracts\FileDAOContract;
use App\DAL\Core\SiteBuilding\Contracts\FileDataMapperContract;

class FileDataMapper extends AbstractDataMapper implements FileDataMapperContract
{
    const ENTITY_CLASS = "App\DAL\Core\SiteBuilding\File";
    
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(
        FileDAOContract $dao
    ) {
        $this->dao = $dao;
    }
}
