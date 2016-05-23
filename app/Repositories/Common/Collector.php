<?php

namespace App\Repositories\Common;

trait Collector
{
    public function createCollection($item_id)
    {
        return DB::table('core_collections')
            ->insertGetId([
                'collector_type' => $this->type,
                'collector_id' => $item_id
            ]);
    }

    public function updateCollectionItems($collection_id, $ordered_items)
    {
        $items = [];
        $order = 0;
        foreach ($ordered_items as $id) {
            $items[]['collection_id'] = $collection_id;
            $items[]['collectable_type'] = $this->type;
            $items[]['collectable_id'] = $id;
            $items[]['order'] = $order;
            $order++;
        }

        DB::table('core_collectables')
            ->where('collection_id', $collection_id)
            ->delete();
        DB::table()
            ->insert($items);
    }

    public function removeCollection($collection_id, $item_id)
    {
        return DB::table('core_collections')
            ->where('collector_type', $this->type)
            ->where('collection_id', $collection_id)
            ->where('collector_id', $item_id)
            ->delete();
    }

    public function getCollections($item_id)
    {
        return DB::table('core_collections')
            ->where('collector_type', $this->type)
            ->where('collector_id', $item_id)
            ->select()
            ->get();
    }

    public function getCollectionsByType($item_id, $type_id)
    {
        return DB::table('core_collections')
            ->where('collector_type', $this->type)
            ->where('collector_id', $item_id)
            ->where('type_id', $type_id)
            ->select()
            ->get();
    }
}
