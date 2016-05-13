<?php

namespace App\Models\Actions\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultDeleter
{
    public function delete($id)
    {
        DB::table(self::TABLE)
            ->where(self::PK, $id)
            ->delete();
    }

    public function deleteMany($ids)
    {
        DB::table(self::TABLE)
            ->whereIn(self::PK, $ids)
            ->delete();
    }
}
