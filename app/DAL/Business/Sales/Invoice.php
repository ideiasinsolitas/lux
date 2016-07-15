<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractModel;

class Invoice extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $hours;

    protected $rate;

    protected $total;

    protected $activity;

    protected $created;

    protected $paid;
}
