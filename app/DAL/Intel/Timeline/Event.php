<?php

namespace App\DAL\Intel\Timeline;

use App\DAL\AbstractEntity;

class Event extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $calendar;
    protected $start;
    protected $end;
}
