<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractModel;

class TimeTracking extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $ticket_id;

    protected $start;

    protected $stop;
}
