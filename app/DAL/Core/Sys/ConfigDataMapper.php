<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\Sys\Contracts\ConfigDAOContract;
use App\DAL\Core\Sys\Contracts\ConfigDataMapperContract;

class ConfigDataMapper extends AbstractDataMapper implements ConfigDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(ConfigDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
