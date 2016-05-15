<?php

namespace App\DAL\Relationships\Common;

trait Collectable
{
    public function addToCollection($collection_id, $item_id, $order)
    {
        return DB::table('core_collections')
            ->insert([
                'id' => $collection_id,
                'collectable_type' => self::INTERNAL_TYPE,
                'collectable_id' => $item_id,
                'order' => $order
            ]);
    }

    public function removeFromCollection($collection_id, $item_id)
    {
        return DB::table('core_collections')
            ->where('id', $collection_id)
            ->where('collectable_type', self::INTERNAL_TYPE)
            ->where('collectable_id', $item_id)
            ->delete();
    }
}
