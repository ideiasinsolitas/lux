<?php

namespace App\DAL;

use App\DAL\Exceptions\MappingException;

trait HasAccessorTrait
{
    protected function has($key)
    {
        $acessor = 'get_' . $key;
        $acessorMethod = Inflector::camelize($acessor);
        if (method_exists($this, $acessorMethod) && $this->$acessorMethod() !== null) {
            return true;
        }
        return false;
    }
}
