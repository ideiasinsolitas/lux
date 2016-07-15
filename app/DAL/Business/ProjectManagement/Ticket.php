<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractModel;

class Ticket extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $responsible_id;

    protected $customer_id;

    protected $project_id;

    protected $problem_url;

    protected $description;

    protected $activity;

    protected $created;

    protected $modified;

    protected $deleted;
}
