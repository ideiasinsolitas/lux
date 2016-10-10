<?php

namespace App\DAL;

use App\DAL\Exceptions\EntityTypeCheckException;

use Carbon\Carbon;

trait TypeValidationTrait
{
    public function _getPropertyList()
    {
        return array_keys($this->_getObjectVars());
    }

    public function _getObjectVars()
    {
        $properties = get_object_vars($this);
        $vars = [];
        foreach ($properties as $key => $value) {
            $allowed = $key[0] !== "_" || $key === "_state";
            if ($allowed) {
                $vars[$key] = $value;
            }
        }
        return $vars;
    }

    protected function checkDateValue($date)
    {
        if (is_string($date)) {
            // return $date;
            return (string) Carbon::parse($date);
        } elseif ($date instanceof \Carbon\Carbon) {
            return (string) $date;
        }
        $msg = 'Invalid type detected for date with value: ' . $date . " Actual type was " . gettype($value) . " in class " . __CLASS__;
        \Log::error($msg);
        throw new EntityTypeCheckException($msg, 1);
    }

    protected function checkValueType($value, $type, $nullable = true)
    {
        if (!$nullable && ($value === null)) {
            \Log::error("Value type " . $type . "cannot be null in class " . __CLASS__);
            throw new EntityTypeCheckException("Error Processing Request", 1);
        } elseif ($value === null) {
            return null;
        }

        switch ($type) {
            case 'bool':
                $oneValues = $value === 1 || $value === "1" || $value === 1.0 || $value === "1.0";
                $zeroValues = $value === 0 || $value === "0" || $value === 0.0 || $value === "0.0";
                $valid = ($oneValues || $zeroValues);
                if (!$valid) {
                    throw new EntityTypeCheckException("value must be integer", 1);
                }
                return (int) $value;
            case 'integer':
                $zeroValues = $value === 0 || $value === "0";
                $valid = ($value || $zeroValues);
                if (!$valid) {
                    throw new EntityTypeCheckException("value must be integer", 1);
                }
                return (int) $value;
            case 'float':
                $valid = is_float((float) $value);
                if (!$valid) {
                    throw new EntityTypeCheckException(" must be float", 1);
                }
                return (float) $value;
            
            case 'string':
                if (!is_string((string) $value)) {
                    throw new EntityTypeCheckException("value must be string", 1);
                }
                return $value;

            default:
                \Log::error('Invalid type detected for type ' . $type . ' with value ' . $value . " Actual type was " . gettype($value) . " in class " . __CLASS__);
                throw new EntityTypeCheckException('Invalid type');
                break;
        }
    }

    protected function createEntity($value, $class, $nullable = true)
    {
        if ($value instanceof $class) {
            return $value;
        }

        if (!$nullable && $value == false) {
            $msg = "Value type cannot be " . $class . " in " . $value . " in class " . __CLASS__;
            \Log::error($msg);
            throw new EntityTypeCheckException($msg, 1);
        }

        $valid = is_array($value) || $value instanceof \stdClass || (int) $value;
        if ($valid) {
            $hydrateExists = method_exists($class, 'hydrate');

            // if value is entity id
            if (intval($value) > 0) {
                $new = [];
                $new['id'] = $value;
                $value = $new;
            }

            if ($hydrateExists) {
                if (!($entity instanceof AbstractEntity)) {
                    throw new EntityTypeCheckException("Object must be class AbstractEntity", 1);
                }
                // is AbstractEntity
                $entity = $class::hydrate($value);
            } else {
                if (!($entity instanceof ValueObject)) {
                    throw new EntityTypeCheckException("Object must be class ValueObject", 1);
                }
                // is ValueObject
                $entity =  new $class($value);
            }
            return $entity;

        } elseif ($value instanceof $class) {
            return $value;

        } elseif ($value == false) {
            $type = gettype($value);
            $msg = 'Invalid type detected for type ' . $type . ' and class ' . $class . ' with value: ' . $value . " in class " . __CLASS__;

            if (!$nullable) {
                \Log::error($msg);
                throw new EntityTypeCheckException($msg, 1);
            } else {
                \Log::info($msg);
            }
        }
        return null;
    }

    protected function createEntityCollection($collection, $class = null, $nullable = true)
    {
        if ($collection instanceof EntityCollection) {
            return $collection;
        }
        
        if ($class === null && is_array($collection)) {
            return new EntityCollection($collection);
        }

        if ($class === null) {
            return null;
        }

        if (!$nullable && $collection == false) {
            $msg = "Value type " . $class . " cannot be " . $collection . " in class " . __CLASS__;
            \Log::error($msg);
            throw new EntityTypeCheckException("Error Processing Request", 1);
        }

        if (is_array($collection) && $class) {
            $entityCollection = new EntityCollection($collection);
            return $entityCollection->transform(function ($item, $key) use ($class) {
                if (!method_exists($class, 'hydrate')) {
                    throw new EntityTypeCheckException("$class does not support hydration.", 1);
                }
                return $class::hydrate($item);
            });
        } elseif ($collection instanceof EntityCollection && $class) {
            return $collection;
            /*
            ->filter(function ($item) {
                return $item instanceof $class;
            });*/
        } elseif ($value == false) {
            $msg = 'Invalid type detected for collection ' . $name . ' and class ' . $class . ' with value: ' . $collection . " in class " . __CLASS__;
            \Log::error($msg);
            if (!$nullable) {
                throw new EntityTypeCheckException($msg, 1);
            }
            return new EntityCollection();
        }
    }

    protected function _getClassFromNamespace($ns)
    {
        $ms = explode("\\", $ns);
        $c = count($ms);
        // se há mais de um resultado, retornar o ultimo, senao retorna o input
        return $c > 1 ? $ms[$c - 1] : $ns;
    }

    // EXPERIMENTAL
    protected function _sniffType($value)
    {
        $float = floatval($value);
        $int = intval($value);
        if ($float && $int) {
            if ($float !== (float) $int) {
                return [
                    'value' => $float,
                    'type' => gettype($float)
                ];
            }
            return [
                'value' => $int,
                'type' => gettype($int)
            ];
        } elseif (is_string($value)) {
            return [
                'value' => $value,
                'type' => gettype($value)
            ];
        } elseif (is_object($value)) {
            return [
                'value' => $value,
                'type' => get_class($value)
            ];
        }
    }
}
