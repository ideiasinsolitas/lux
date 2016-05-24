<?php

namespace App\Models;

abstract class DAOFactory
{
    public static function factory($namespace)
    {
        $class = $namespace . 'DAO';
        return new $class();
    }
}
