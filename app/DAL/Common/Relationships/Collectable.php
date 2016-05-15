<?php

namespace App\DAL\Relationships\Common;

trait Collectable
{
    public function addToCollection($collection_id, $item_id, $order)
    {
        if (!is_int($collection_id) || !is_int($item_id) || !is_int($order)) {
            throw new \Exception("Error Processing Request", 1);
        }
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
        if (!is_int($collection_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collections')
            ->where('id', $collection_id)
            ->where('collectable_type', self::INTERNAL_TYPE)
            ->where('collectable_id', $item_id)
            ->delete();
    }

    public function clearCollection($collection_id)
    {
        if (!is_int($collection_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        DB::table('core_collectables')
            ->where('collection_id', $collection_id)
            ->delete();
    }
}
