<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;

class Payment extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $id;

    protected $invoice_id;

    protected $type_id;

    protected $amount;

    public function __toString()
    {
        return '';
    }
}
