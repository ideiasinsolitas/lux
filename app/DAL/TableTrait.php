<?php

namespace App\DAL;

use Illuminate\Support\Facades\DB;

trait TableTrait
{
    public function create()
    {
        $sql = $this->getSqlSchema();
        $pdo = DB::connection()->getPdo();
        return $pdo->exec($sql) ? true : false;
    }

    public function drop()
    {
        $sql = "DROP TABLE " . implode(',', $this->getTableNames);
        $pdo = DB::connection()->getPdo();
        return $pdo->exec($sql) ? true : false;
    }

    public function dropAndCreate()
    {
        return $this->drop() && $this->create();
    }

    public function getTableNames()
    {
        return $this->tableNames;
    }
}
