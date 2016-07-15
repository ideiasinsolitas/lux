<?php

namespace App\DAL\Features;

use Illuminate\Support\Facades\DB;

trait DAOActivityTrait
{
    public function activate($item_id)
    {
        return DB::table($this->table)->where($this->primaryKey, $item_id)->update(['active' => 1]);
    }

    public function deactivate($item_id)
    {
        return DB::table($this->table)->where($this->primaryKey, $item_id)->update(['active' => 0]);
    }
}
