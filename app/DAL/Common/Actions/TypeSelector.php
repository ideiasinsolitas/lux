<?php

namespace App\DAL\Actions\Common;

use App\DAL\Core\TypeDAO;

trait TypeSelector
{
    public function getAvaiableTypes()
    {
        return DB::table('core_types')
            ->select('core_types.name')
            ->where('class', self::INTERNAL_TYPE)
            ->get();
    }

    public function changeType($pk, $type_id)
    {
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update(['type_id' => $type_id]);
    }
}
