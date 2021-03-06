<?php

namespace App\DAL\Common\Actions;

use Illuminate\Support\Facades\DB;

trait TypeSelector
{
    public function getAvaiableTypes()
    {
        return DB::table('core_types')
            ->select('core_types.name')
            ->where('core_types.class', self::INTERNAL_TYPE)
            ->get();
    }

    public function changeType($pk, $type_id)
    {
        if (!is_int($pk) || !is_int($type_id)) {
            throw new \Exception("Error Processing Request", 1);
        }
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update(['type_id' => $type_id]);
    }
}
