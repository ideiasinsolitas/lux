<?php

namespace App\DAL\Common\Properties;

use App\DAL\Exceptions\EntityTypeCheckException;

trait Identifiable
{
    protected $id;

    public function setId($value)
    {
        if (method_exists($this, "checkValueType")) {
            $id = $this->checkValueType($value, 'integer');
        } else {
            $id = (int) $value;
        }
        if (intval($id) < 1) {
            $msg = "invalid id: " . $id;
            throw new EntityTypeCheckException($msg, 1);
        }
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }
}
