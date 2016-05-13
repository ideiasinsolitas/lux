<?php

namespace App\Models\Relationships\Common;

use Illuminate\Support\Facade\DB;

trait Nodable
{
    public function createNode($type)
    {
        return DB::table('core_nodes')
            ->insertGetId(['type', $type]);
    }
}
