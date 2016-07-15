<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractModel;

class Order extends AbstractModel
{
    use DefaultModelTrait;

    protected $id;

    protected $customer_id;

    protected $seller_id;

    protected $invoice_id;

    protected $payment_method;

    protected $shipping_method;

    protected $price;

    protected $taxes;

    protected $extra_cost;

    protected $shipping_cost;

    protected $total;

    protected $created;

    protected $closed;
}
