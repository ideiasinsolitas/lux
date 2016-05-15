<?php

namespace App\Models;

trait DefaultModifier
{
    public function insert(array $input)
    {
        return DB::table(self::TABLE)
            ->insertGetId($input);
    }

    public function update(array $input, $pk)
    {
        return DB::table(self::TABLE)
            ->update($input)
            ->where(self::PK, $pk);
    }
}
