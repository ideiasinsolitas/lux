<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;

class Invoice extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $id;

    protected $activity;

    protected $created;

    protected $hours;

    protected $rate;

    protected $amount;

    protected $paid;

    public function __toString()
    {
        return '';
    }
}
