<?php

namespace App\DAL;

use Illuminate\Support\Collection;

class EntityCollection extends Collection
{
    use SerializableTrait;
    
    const SEPARATOR = "\n";

    public function __toString()
    {
        $map = array_map(function ($v) {
            return (string) $v;
        }, $this->items);

        return implode(self::SEPARATOR, $map);
    }

    public function getHashes()
    {
        $hashes = [];
        foreach ($this->items as $item) {
            $hashes[$item->id] = $item->getHash();
        }
        return $hashes;
    }
}
