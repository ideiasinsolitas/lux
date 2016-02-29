<?php

namespace App\Repositories\Relationships\Common;

trait Collectable
{
    public function addToCollection($collection_id, $item_id)
    {
        $collectable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collections')
            ->insert([
                'id' => $collection_id,
                'collectable_type' => $collectable_type,
                'collectable_id' => $item_id,
            ]);
    }

    public function removeFromCollection($collection_id, $item_id)
    {
        $collectable_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collections')
            ->where('id', $collection_id)
            ->where('collectable_type', $collectable_type)
            ->where('collectable_id', $item_id)
            ->delete();
    }
}
