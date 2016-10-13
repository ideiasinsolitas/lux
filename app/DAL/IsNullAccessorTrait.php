<?php

namespace App\DAL;

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
