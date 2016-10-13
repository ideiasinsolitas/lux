<?php

namespace App\DAL;

trait SerializableTrait
{
    public function toArray()
    {
        if (method_exists($this, '_getObjectVars')) {
            $properties = $this->_getObjectVars($this);
        } elseif (property_exists($this, 'items')) {
            $properties = $this->items;
        } else {
            $properties = get_object_vars($this);
        }
        $vars = [];

        foreach ($properties as $key => $value) {
            if ($key[0] === '_') {
                continue;
            }
            if (method_exists($value, 'toArray')) {
                $data = $value->toArray();
            } else {
                $data = $value;
            }
            $vars[$key] = $data;
        }
        return $vars;
    }

    public function toJson($options = 0)
    {
        return json_encode($this->toArray(), $options);
    }

    public function serialize()
    {
        return serialize($this->toJson());
    }
}
