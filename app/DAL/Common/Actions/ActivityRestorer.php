<?php

namespace App\DAL\Actions\Common;

trait ActivityRestorer
{
    public function restore($pk)
    {
        return DB::table(self::TABLE)
            ->update(['activity' => 1, 'deleted' => null])
            ->where(self::PK, $pk);
    }
}
