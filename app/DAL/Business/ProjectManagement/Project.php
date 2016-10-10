<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractEntity;
use App\DAL\EntityCollection;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

use Carbon\Carbon;

class Project extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Nodable,
        Properties\Name,
        Properties\Description,
        Properties\Activity;

    protected $tickets;

    public function setTickets($value)
    {
        $this->tickets = $this->createEntityCollection($value, "App\DAL\Business\ProjectManagement\Ticket");
    }

    public function getTickets()
    {
        $isCollection = $this->tickets instanceof EntityCollection;
        return $isCollection ? $this->tickets : new EntityCollection();
    }
}
