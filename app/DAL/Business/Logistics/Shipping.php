<?php

namespace App\DAL\Business\Logistics;

use App\DAL\AbstractModel;

class Shipping extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $order_id;

    protected $type_id;

    protected $tracking_ref;

    protected $activity;

    protected $created;

    protected $shipped;

    protected $delivered;
}
