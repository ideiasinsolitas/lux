<?php

namespace App\DAL\Common\Actions;

use Illuminate\Support\Facades\DB;

trait ActivityRestorer
{
    public function restore($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table(self::TABLE)
            ->update(['activity' => 1, 'deleted' => null])
            ->where(self::PK, $pk);
    }
}
