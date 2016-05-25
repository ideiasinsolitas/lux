<?php

namespace App\DAL\Common\Relationships;

trait Collector
{
    public function createCollection($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collections')
            ->insertGetId([
                'collector_type' => self::INTERNAL_TYPE,
                'collector_id' => $item_id
            ]);
    }

    public function removeCollection($collection_id, $item_id)
    {
        if (!is_int($collection_id) || !is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collections')
            ->where('core_collections.id', $collection_id)
            ->where('core_collections.collector_type', self::INTERNAL_TYPE)
            ->where('core_collections.collector_id', $item_id)
            ->delete();
    }

    public function getCollections($item_id)
    {
        if (!is_int($item_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table('core_collections')
            ->select(
                'core_collections.id',
                'core_collections.node_id',
                'core_collections.type_id',
                'core_collections.created',
                'core_collections.modified',
                'core_collections.deleted'
            )
            ->where('core_collections.collector_type', self::INTERNAL_TYPE)
            ->where('core_collections.collector_id', $item_id)
            ->get();
    }
}
