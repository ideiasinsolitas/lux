<?php

namespace App\DAL\Common\Contract;

interface OrderableContract
{
    const ORDER_TABLE = "business_orders";

    public function addItems($order_id, array $items);

    public function removeItem($order_id, $item_id);
}
