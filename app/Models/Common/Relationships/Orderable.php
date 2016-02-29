<?php

namespace App\Repositories\Relationships\Common;

use Illuminate\Support\Facades\DB;

trait Orderable
{
    public function addItems($order_id, $item_info)
    {
        $orderable_type = DB::raw('\"' . $this->type . '\"');
        $items = [];
        foreach ($item_info as $item) {
            $items[]['order_id'] = $order_id;
            $items[]['orderable_type'] = $orderable_type;
            $items[]['orderable_id'] = $item['id'];
            $items[]['price'] = $item['price'];
            isset($item['quantity']) ? $item['quantity'] : 1;
        }
        DB::table('business_orderarbles')
           ->insert($items);
    }

    public function removeItem($order_id, $item_id)
    {
        $orderable_type = DB::raw('\"' . $this->type . '\"');
        DB::table('business_orderarbles')
            ->where('order_id', $order_id)
            ->where('orderable_type', $orderable_type)
            ->where('orderable_id', $item_id)
            ->delete();
    }
}
