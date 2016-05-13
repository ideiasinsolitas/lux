<?php

namespace App\Models\Actions\Common;

use App\Models\Core\TypeDAO;

trait TypeSelector
{
    public function getAvaiableTypes()
    {
        return DB::table(TypeDAO::TABLE)
            ->select(TypeDAO::TABLE . '.name', 'name')
            ->where('class', $this->type)
            ->get();
    }

    public function changeType($pk, $type_id)
    {
        return DB::table(self::TABLE)
            ->where(self::PK, $pk)
            ->update(['type_id' => $type_id]);
    }
}
