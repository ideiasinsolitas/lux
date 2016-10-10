<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\Sys\Contracts\UserDAOContract;
use App\DAL\Core\Sys\Contracts\UserDataMapperContract;
use App\DAL\Core\Sys\Contracts\ConfigDataMapperContract;

class UserDataMapper extends AbstractDataMapper implements UserDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;

    protected $configs;

    public function __construct(UserDAOContract $dao, ConfigDataMapperContract $configs)
    {
        $this->dao = $dao;
        $this->configs = $configs;
    }

    protected function saveRelationships($model)
    {
        foreach ($model->configs->all() as $config) {
            $this->configs->save($config);
        }
    }
}
