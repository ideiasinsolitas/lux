<?php

namespace App\Models\Relationships\Common;

trait Collector
{
    public function createCollection($item_id)
    {
        $collector_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collections')
            ->insertGetId([
                'collector_type' => $collector_type,
                'collector_id' => $item_id
            ]);
    }

    public function removeCollection($collection_id, $item_id)
    {
        $collector_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collections')
            ->where('id', $collection_id)
            ->where('collector_type', $collector_type)
            ->where('collector_id', $item_id)
            ->delete();
    }

    public function getCollections($item_id)
    {
        $collector_type = DB::raw('\"' . $this->type . '\"');
        return DB::table('core_collections')
            ->where('collector_type', $collector_type)
            ->where('collector_id', $item_id)
            ->select()
            ->get();
    }
}
