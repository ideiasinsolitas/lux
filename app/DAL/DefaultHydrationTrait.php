<?php
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\DAL;

use App\DAL\Exceptions\EntityTypeCheckException;

trait DefaultHydrationTrait
{
    public static function hydrate($data)
    {
        return self::_hydrate($data);
    }

    protected static function _hydrate($data)
    {
        $class = __CLASS__;
        if ($data instanceof $class) {
            return $data;
        }

        if (!is_array($data) && (!$data instanceof \stdClass)) {
            if ($data !== null) {
                $msg = "Data must be array or stdClass. Actual type was "
                    . gettype($data)
                    . " in class "
                    . __CLASS__;
                \Log::error($msg);
            }
            throw new EntityTypeCheckException($msg, 1);
        }

        if ($data instanceof \stdClass) {
            $data = (array) $data;
        }

        $object = new static();
        foreach ($data as $key => $value) {
            if ($value instanceof \stdClass) {
                $value = (array) $value;
            }
            $loggableValue = is_array($value) ? print_r($value, true) : $value;
            $properties = $object->_getPropertyList();
            if (in_array($key, $properties) && $loggableValue !== null) {
                if (method_exists($object, 'set')) {
                    $object->set($key, $value);
                } else {
                    \Log::warning("SetterAccessorTrait::set() not present in " . __CLASS__);
                }
            }
            if ($key === '_state') {
                $object->setState($value);
                // \Log::info("Object " . __CLASS__ . " state is now: " . $value);
            }
        }
        return $object;
    }

    public static function createFromId($id)
    {
        $object = new static();
        $object->id = $id;
        return $object;
    }

    public static function createCollectionFromIds($ids)
    {
        $collection = new EntityCollection();
        foreach ($ids as $id) {
            $object = new static();
            $object->id = $id;
            $collection->push($object);
        }
        return $collection;
    }
}
