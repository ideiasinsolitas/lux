<?php

namespace App\DAL;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

trait DAOSoftDeleteTrait
{
    public function trash($id)
    {
        return DB::table(self::TABLE)
            ->where(self::PK, $id)
            ->update([self::TABLE . '.deleted' => Carbon::now()]);
    }

    public function restore($id)
    {
        return DB::table(self::TABLE)
            ->where(self::PK, $id)
            ->update([self::TABLE . '.deleted' => null]);
    }

    public function getTrashed()
    {
        return $this->builder
            ->where(self::PK, $id)
            ->where(self::TABLE . '.deleted', '!=', null)
            ->get();
    }
}
