<?php

namespace App\DAL\Actions\Common;

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
