<?php

namespace App\DAL\Core\Sys\Tables;

use App\DAL\AbstractTable;
use App\DAL\TableTrait;

class UserTable extends AbstractTable
{
    use TableTrait;

    public function getSqlSchema()
    {
        return "
        ";
    }
}
