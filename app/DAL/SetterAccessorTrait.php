<?php

namespace App\DAL;

use App\DAL\Exceptions\MappingException;

trait SetterAccessorTrait
{
    public function __set($key, $value)
    {
        $properties = $this->_getPropertyList();
        if (in_array($key, $properties)) {
            return $this->set($key, $value);
        }
    }

    protected function set($key, $value)
    {
        $properties = $this->_getPropertyList();
        $success = false;
        $acessor = 'set_' . $key;
        $acessorMethod = Inflector::camelize($acessor);
        $zeroValues = $value === 0 || $value === "0" || $value === 0.0 || $value === "0.0";
        $valid = ($value || $zeroValues);
        $hasAccessorMethod = method_exists($this, $acessorMethod);
        if ($valid && $hasAccessorMethod) {
            $this->$acessorMethod($value);
            $success = true;
        } else {
            if ($value instanceof \stdClass) {
                $value = (array) $value;
            }
            $loggableValue = is_array($value) ? print_r($value, true) : $value;
            if ($loggableValue !== null) {
                $loggableValue = is_object($loggableValue) ? get_class($loggableValue) : $loggableValue;
                $msg = "SetterAccessorTrait: Could not set the value of " . $key . " with value of " . $loggableValue . " and type of " . gettype($value) . " in class " . __CLASS__ . " in setter";
                in_array($key, $properties) ? $msg .= ", " . $key . " not in properties" : $msg .= ".";
                \Log::warning($msg);
            }
        }
        return $success;
    }
}
