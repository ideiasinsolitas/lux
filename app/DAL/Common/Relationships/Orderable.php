<?php

namespace App\DAL\Common\Relationships;

use Illuminate\Support\Facades\DB;

trait Orderable
{
    public function addItems($order_id, array $items)
    {
        if (!is_int($order_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        $c = count($items);
        for ($i=0; $i <$c; $i++) {
            $items[$i]['order_id'] = $order_id;
            $items[$i]['orderable_type'] = self::INTERNAL_TYPE;
            $items[$i]['orderable_id'] = $item['id'];
            $items[$i]['price'] = $item['price'];
            isset($items[$i]['quantity']) ? $items[$i]['quantity'] : 1;
        }
        DB::table('business_orderables')
           ->insert($items);
    }

    public function removeItem($order_id, $item_id)
    {
        if (!is_int($order_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        DB::table('business_orderables')
            ->where('business_orderables.order_id', $order_id)
            ->where('business_orderables.orderable_type', self::INTERNAL_TYPE)
            ->where('business_orderables.orderable_id', $item_id)
            ->delete();
    }
}
