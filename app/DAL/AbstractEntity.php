<?php

namespace App\DAL;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;

abstract class AbstractEntity implements Jsonable
{
    /**
     * /
     * @return [type] [description]
     */
    abstract public function toArray();

    /**
     * /
     * @return [type] [description]
     */
    abstract public function toJson($options = 0);

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
