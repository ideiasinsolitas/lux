<?php

namespace App\DAL\Features;

use Illuminate\Support\Facades\DB;

trait DAOOwnerTrait
{
    public function getOwnerId($id)
    {
        return DB::table(self::TABLE)
            ->select(self::TABLE . '.' . self::PK)
            ->where(self::TABLE . '.user_id', $id)
            ->first();
    }
}
