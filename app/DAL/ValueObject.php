<?php

namespace App\DAL;

class ValueObject
{
    use GetterAccessorTrait, SerializableTrait, TypeValidationTrait;

    public function __construct(array $data = array())
    {
        $properties = array_keys($this->_getObjectVars());
        foreach ($data as $key => $value) {
            $properties = $this->_getPropertyList();
            if (in_array($key, $properties)) {
                if (method_exists($this, 'set')) {
                    return $this->set($key, $value);
                } else {
                    \Log::warning("SetterAccessorTrait::set() not present in " . __CLASS__);
                    // comment this line for production
                    $this->$key = $value;
                }
            }
        }
    }

    protected function set($key, $value)
    {
        $success = false;
        $acessor = 'set_' . $key;
        $acessorMethod = Inflector::camelize($acessor);
        $zeroValues = $value === 0 || $value === "0" || $value === 0.0 || $value === "0.0";
        $valid = ($value || $zeroValues);
        $hasAccessorMethod = method_exists($this, $acessorMethod);
        if ($valid && $hasAccessorMethod) {
            $this->$acessorMethod($value);
            $success = true;
        }
        if ($value instanceof \stdClass) {
            $value = (array) $value;
        }
        $loggableValue = is_array($value) ? print_r($value, true) : $value;
        $msg = "SetterAccessorTrait: Could not set the value of " . $key . " with value of " . $loggableValue . " and type of " . gettype($value) . " in class " . __CLASS__ . " in setter ";
        if (in_array($key, $properties)) {
            $msg .= " " . $key . " not in properties";
        }
        \Log::warning($msg);
        return $success;
    }

    public function equalsTo(ValueObject $value)
    {
        $vars = $this->_getObjectVars($value);
        $self_vars = $this->_getObjectVars($this);

        // var list is different -> NOT EQUAL
        if ($vars !== $self_vars) {
            return false;
        }

        foreach ($vars as $key => $val) {
            // skip internal properties prefixed with the '_' character
            if ($key[0] === '_') {
                continue;
            }
            // accessor method underline repr
            $acessor = 'get_' . $key;
            // accessor method camelcase repr
            $acessorMethod = Inflector::camelize($acessor);

            // has accessor or value is different -> NOT EQUAL
            if (method_exists($this, $acessorMethod) || $val !== $this->$acessorMethod()) {
                return false;
            }
        }
        // has all accessors and every value is the same -> EQUAL
        return true;
    }
}
