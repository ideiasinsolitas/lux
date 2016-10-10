<?php

namespace App\DAL\Common\Properties;

use App\DAL\Core\SiteBuilding\Node;
use App\DAL\Exceptions\EntityTypeCheckException;

trait Nodable
{
    protected $node;

    public function setNode($value)
    {
        if (method_exists($this, "createEntity")) {
            $node = $this->createEntity($value, "\App\DAL\Core\SiteBuilding\Node");
        } else {
            $node = $value;
        }
        if ($node !== null && !($node instanceof Node)) {
            throw new EntityTypeCheckException("Error Processing Request", 1);
        }
        $this->node = $node;
    }

    public function getNode()
    {
        return $this->node;
    }
}
