<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;

trait TableTrait
{
    public function create()
    {
        $sql = $this->getSqlSchema();
    }

    public function drop()
    {
        $sql = "DROP TABLE " . implode(',', $this->getTableNames);
    }

    public function dropAndCreate()
    {
        $this->drop();
        $this->create();
    }

    public function getTableNames()
    {
        return $this->tableNames;
    }
}
