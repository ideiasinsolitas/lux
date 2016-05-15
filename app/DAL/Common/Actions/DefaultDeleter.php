<?php

namespace App\DAL\Actions\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultDeleter
{
    public function delete($pk)
    {
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->delete();
    }

    public function deleteMany($pks)
    {
        return DB::table(self::TABLE)
            ->whereIn(self::PK, $pks)
            ->delete();
    }
}
