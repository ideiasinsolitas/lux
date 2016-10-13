<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;
use App\DAL\Business\ProjectManagement\Contracts\TimeTrackingDAOContract;
use App\DAL\Business\ProjectManagement\Contracts\TimeTrackingDataMapperContract;

class TimeTrackingDataMapper extends AbstractDataMapper implements TimeTrackingDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;
    
    public function __construct(TimeTrackingDAOContract $dao)
    {
        $this->dao = $dao;
    }
}
