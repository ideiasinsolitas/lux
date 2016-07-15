<?php

namespace App\DAL\Features;

use Illuminate\Support\Facades\DB;

trait LastInsertIdTrait
{
    /**
     *
     * @return [type] [description]
     */
    public function getLastInsertId()
    {
        return DB::getPdo()->lastInsertId();
    }
}
