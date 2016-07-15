<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractModel;

class Payment extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $invoice_id;

    protected $type_id;

    protected $amount;
}
