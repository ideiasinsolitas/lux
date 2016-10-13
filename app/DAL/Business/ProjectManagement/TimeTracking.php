<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class TimeTracking extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable;

    protected $ticket;

    protected $start;

    protected $stop;


    public function setTicket($value)
    {
        $this->ticket = $this->createEntity($value, "Ticket");
    }

    public function getTicket()
    {
        return $this->ticket || new Ticket();
    }

    public function setStart($value)
    {
        $this->start = $this->checkDate($value);
    }

    public function getStart()
    {
        return $this->start;
    }

    public function setStop($value)
    {
        $this->stop = $this->checkDate($value);
    }

    public function getStop()
    {
        return $this->stop;
    }
}
