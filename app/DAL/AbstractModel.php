<?php

namespace App\DAL\Abstractions;

use App\DAL\Contracts\DefaultModelContract;

abstract class AbstractModel implements DefaultModelContract
{
    /**
     * /
     * @param  array  $data [description]
     * @return [type]       [description]
     */
    abstract public static function hydrate($data);

    /**
     * /
     * @return [type] [description]
     */
    abstract public function toArray();

    /**
     * /
     * @return string [description]
     */
    abstract public function __toString();

    /**
     * /
     * @param [type] $key   [description]
     * @param [type] $value [description]
     */
    abstract public function __set($key, $value);

    /**
     * /
     * @param  [type] $key [description]
     * @return [type]      [description]
     */
    abstract public function __get($key);
}
