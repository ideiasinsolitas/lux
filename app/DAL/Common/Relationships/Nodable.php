<?php

namespace App\DAL\Common\Relationships;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

trait Nodable
{
    public function createNode()
    {
        $node = [];
        $node['parent_id'] = 0;
        $node['class'] = self::INTERNAL_TYPE;
        $node['activity'] = 1;
        $node['created'] = Carbon::now();
        $node['modified'] = Carbon::now();
        return DB::table('core_nodes')
            ->insertGetId($node);
    }

    public function getOneByNodeId($node_id)
    {
        if (!is_int($node_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->parseFilters(['node_id' => $node_id]);
    }
}
