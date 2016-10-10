<?php

namespace App\DAL;

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
