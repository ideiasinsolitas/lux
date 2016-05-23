<?php

namespace App\Repositories\Common;

trait Collectable
{
    public function addToCollection($collection_id, $item_id)
    {
        return DB::table('core_collections')
            ->insert([
                'collection_id' => $collection_id,
                'collectable_type' => $this->type,
                'collectable_id' => $item_id,
            ]);
    }

    public function removeFromCollection($collection_id, $item_id)
    {
        return DB::table('core_collections')
            ->where('collection_id', $collection_id)
            ->where('collectable_type', $this->type)
            ->where('collectable_id', $item_id)
            ->delete();
    }
}
