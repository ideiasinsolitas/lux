<?php

namespace App\DAL;

use App\DAL\Exceptions\MappingException;

trait IsNullAccessorTrait
{
    public function isNull()
    {
        $isNull = true;
        $vars = $this->_getObjectVars();
        foreach ($vars as $key => $var) {
            if ($key[0] !== "_" && $var !== null) {
                $isNull = false;
            }
        }
        return $isNull;
    }
}
