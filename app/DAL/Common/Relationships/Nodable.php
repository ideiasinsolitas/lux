<?php

namespace App\DAL\Relationships\Common;

use Illuminate\Support\Facade\DB;

trait Nodable
{
    public function createNode()
    {
        return DB::table('core_nodes')
            ->insertGetId(['type', self::INTERNAL_TYPE]);
    }

    public function getOneByNodeId($node_id)
    {
        return $this->parseFilters(['node_id' => $node_id]);
    }
}
