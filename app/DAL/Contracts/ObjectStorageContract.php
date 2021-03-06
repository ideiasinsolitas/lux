<?php

namespace App\DAL\Contracts;

interface ObjectStorageContract extends \Countable, \Iterator, \ArrayAccess
{
    public function attach($object, $data = null);
    public function detach($object);
    public function clear();
}
