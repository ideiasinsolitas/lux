<?php

namespace App\Repositories\Actions\Common;

/**
 * @author Pedro Koblitz
 * @package Maltz
 * @subpackage Http
 */

trait DefaultDeleter
{
    public function delete($id)
    {
        DB::table($this->table)
            ->where('id', $id)
            ->delete();
    }

    public function deleteMany($ids)
    {
        DB::table($this->table)
            ->whereIn('id', $ids)
            ->delete();
    }
}
