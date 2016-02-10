<?php

namespace App\Repositories\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultDeleter
{
    public function delete($id)
    {
        DB::table($this->mainTable)
            ->where('id', $id)
            ->delete();
    }

    public function deleteMany($ids)
    {
        DB::table($this->mainTable)
            ->whereIn('id', $ids)
            ->delete();
    }
}
