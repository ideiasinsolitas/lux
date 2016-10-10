<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\Sys\Contracts\TypeDAOContract;
use App\DAL\Core\Sys\Contracts\TypeDataMapperContract;

class TypeDataMapper extends AbstractDataMapper implements TypeDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(TypeDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
