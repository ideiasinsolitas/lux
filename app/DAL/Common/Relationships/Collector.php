<?php

namespace App\DAL\Relationships\Common;

trait Collector
{
    public function createCollection($item_id)
    {
        return DB::table('core_collections')
            ->insertGetId([
                'collector_type' => self::INTERNAL_TYPE,
                'collector_id' => $item_id
            ]);
    }

    public function removeCollection($collection_id, $item_id)
    {
        return DB::table('core_collections')
            ->where('id', $collection_id)
            ->where('collector_type', self::INTERNAL_TYPE)
            ->where('collector_id', $item_id)
            ->delete();
    }

    public function getCollections($item_id)
    {
        return DB::table('core_collections')
            ->select('id', 'node_id', 'type_id', 'created', 'modified', 'deleted')
            ->where('collector_type', self::INTERNAL_TYPE)
            ->where('collector_id', $item_id)
            ->get();
    }
}
