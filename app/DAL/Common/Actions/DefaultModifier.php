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
        if (!is_int($pk)) {
            throw new \Exception("Error Processing Request", 1);
        }

        return DB::table(self::TABLE)
            ->update($input)
            ->where(self::PK, $pk);
    }
}
