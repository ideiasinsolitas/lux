<?php

namespace App\DAL\Core\Sys;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\Sys\Contracts\NotificationDAOContract;
use App\DAL\Core\Sys\Contracts\NotificationDataMapperContract;

class NotificationDataMapper extends AbstractDataMapper implements NotificationDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;

    public function __construct(NotificationDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
