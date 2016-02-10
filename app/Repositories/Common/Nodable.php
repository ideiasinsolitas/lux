<?php

namespace App\Repositories\Common;

use Illuminate\Support\Facade\DB;

trait Nodable
{
    public function createNode($type)
    {
        DB::table('core_nodes')
            ->insertGetId(['type', $type]);
    }
}
