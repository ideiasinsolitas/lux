<?php

namespace App\Repositories\Business\ProjectManagement;

use App\Exceptions\GeneralException;
use App\Models\Project\TimeTracking;

class TimeTrackingRepository
{
    public function __construct()
    {
        $this->model = 'App\Models\Business\Project\TimeTracking\TimeTracking';
    }

    public function start()
    {
        if (!$this->getCurrentId()) {
        }
    }
    
    public function stop()
    {
        $id = $this->getCurrentId();
        if ($id) {
        }
    }
    
    public function getCurrentId()
    {
    

    }
}
