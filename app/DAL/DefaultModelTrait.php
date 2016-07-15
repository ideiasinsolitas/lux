<?php
/*
 * This file is part of the AllScorings package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package AllScorings
 */

namespace App\DAL\Features;

use App\DAL\Inflector;

trait DefaultModelTrait
{
    protected $dirty = false;

    public function isDirty()
    {
        return $this->dirty;
    }

    public static function createFromId($id)
    {
        $object = new static();
        $object->id = $id;
        $object->dirty = false;
        return $object;
    }

    public static function createCollectionFromIds($ids)
    {
        $collection = new Collection();
        foreach ($ids as $id) {
            $object = new static();
            $object->id = $id;
            $object->dirty = false;
            $collection->add($object);
        }
        return $collection;
    }

    public static function hydrate($data)
    {
        if (!is_array($data) || !($data instanceof \stdClass)) {
            throw new \Exception("data must be array or stdClass", 1);
        }
        if ($data instanceof \stdClass) {
            $data = (array) $data;
        }
        $object = new static();
        foreach ($data as $key => $value) {
            $object->$key = $value;
        }
        $object->dirty = false;
        return $object;
    }

    public function toArray()
    {
        $properties = $this->getObjectVars();
        return array_filter(array_map(function ($v) {
            if (is_object($v)) {
                return false;
            }
            return $v;
        }, $properties));
    }

    public function toArrayDeep()
    {
        $properties = $this->getObjectVars();
        return array_filter(array_map(function ($v) {
            if (is_object($v) && method_exists($v, "toArray")) {
                return $v->toArray();
            } elseif (is_object($v)) {
                return false;
            }
            return $v;
        }, $properties));
    }

    protected function getObjectVars()
    {
        $properties = get_object_vars($this);
        return $properties;
    }

    public function toJson()
    {
        return json_encode($this->toArrayDeep());
    }

    public function __set($key, $value)
    {
        $acessor = 'set_' . $key;
        $acessorMethod = Inflector::camelize($acessor);
        if (method_exists($this, $acessorMethod)) {
            if ($object->$key !== $value) {
                $this->dirty = true;
            }
            $object->$acessorMethod($value);
        }
        // throw new InvalidPropertyException("Property $key does not exist.");
    }

    public function __get($key)
    {
        $acessor = 'get_' . $key;
        $acessorMethod = Inflector::camelize($acessor);
        if (method_exists($this, $acessorMethod)) {
            return $object->$acessorMethod();
        }
        // throw new InvalidPropertyException("Property $key does not exist.");
        return false;
    }
}
