<?php

namespace App\DAL;

use App\DAL\Exceptions\MappingException;

trait GetterAccessorTrait
{
    protected function get($key)
    {
        $acessor = 'get_' . $key;
        $acessorMethod = Inflector::camelize($acessor);
        if (method_exists($this, $acessorMethod)) {
            return $this->$acessorMethod();
        }
        $msg = "Could not get the value of " . $key . " from object: " . __CLASS__ . " in getter";
        \Log::warning($msg);
    }

    public function __get($key)
    {
        $properties = $this->_getPropertyList();
        if (in_array($key, $properties)) {
            return $this->get($key);
        }
        return false;
    }
}
