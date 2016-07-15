<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractModel;

class Project extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $node_id;

    protected $name;

    protected $description;

    protected $activity;
}
