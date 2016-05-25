<?php

namespace App\DAL\Common\Relationships;

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
        if (!is_int($node_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return $this->parseFilters(['node_id' => $node_id]);
    }
}
