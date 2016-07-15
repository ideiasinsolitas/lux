<?php

namespace App\DAL\Common\Contract;

interface OrderableContract
{
    public function addItems($order_id, array $items);

    public function removeItem($order_id, $item_id);
}
