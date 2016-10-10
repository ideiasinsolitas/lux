<?php

namespace App\DAL\Common\Properties;

use App\DAL\Exceptions\EntityTypeCheckException;

trait Hierarchical
{
    protected $parent;

    protected $children;

    public function setParent($value)
    {
        $class = __CLASS__;
        $parent = $this->createEntity($value, $class);
        $this->parent = $parent;
    }

    public function getParent()
    {
        return $this->parent;
    }

    public function setChildren($value)
    {
        $class = __CLASS__;
        $children = $this->createEntityCollection($value, $class);
        $this->children = $children;
    }

    public function getChildren()
    {
        return $this->children;
    }
}
