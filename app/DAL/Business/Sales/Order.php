<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;

class Order extends AbstractEntity
{
    use DefaultEntityTrait;

    protected $id;

    protected $customer;

    protected $seller;

    protected $invoice;

    protected $shipping;

    protected $payments;

    protected $price;

    protected $taxes;

    protected $extra_cost;

    protected $total;

    protected $created;

    protected $closed;

    public function getTotal()
    {
        $shipping = $this->shipping && $this->shipping->cost ? $this->shipping->cost : 0;
        return $this->price + $this->taxes + $this->extra_cost + $shipping;
    }

    public function __toString()
    {
        return '';
    }
}
