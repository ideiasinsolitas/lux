<?php

namespace App\DAL\Common\Actions;

use Illuminate\Support\Facades\DB;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultDeleter
{
    public function delete($pk)
    {
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->delete();
    }

    public function deleteMany(array $pks)
    {
        return DB::table(self::TABLE)
            ->whereIn(self::PK, $pks)
            ->delete();
    }
}
