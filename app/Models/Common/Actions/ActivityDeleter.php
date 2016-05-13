<?php

namespace App\Models\Actions\Common;

use Carbon\Carbon;

trait ActivityDeleter
{
    public function delete($id)
    {
        return DB::table(self::TABLE)
            ->update(['activity' => 0, 'deleted' => Carbon::now()])
            ->where(self::PK, $id);
    }

    public function deleteMany($ids)
    {
        return DB::table(self::TABLE)
            ->update(['activity' => 0, 'deleted' => Carbon::now()])
            ->whereIn(self::PK, $ids);
    }

    public function restore($id)
    {
        return DB::table(self::TABLE)
            ->update(['activity' => 1, 'deleted' => null])
            ->whereIn(self::PK, $ids);
    }
}
