<?php

namespace App\DAL;

use App\DAL\Contracts\ObjectStorageContract;

class ObjectStorage extends \SplObjectStorage implements ObjectStorageContract
{
    public function clear()
    {
        $tempStorage = clone $this;
        $this->addAll($tempStorage);
        $this->removeAll($tempStorage);
        $tempStorage = null;
    }
}
