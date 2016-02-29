<?php

namespace App\Repositories\Actions\Common;

trait TypeSelector
{
    public function getAvaiableTypes()
    {
        return DB::table('core_types')
            ->select('id', 'name')
            ->where('class', $this->type)
            ->get();
    }
}
