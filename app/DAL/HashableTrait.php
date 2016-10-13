<?php

namespace App\DAL;

trait HashableTrait
{
    protected $_hash = null;

    protected function hash($value = null)
    {
        if (!$value && method_exists($this, 'serialize')) {
            $value = $this->serialize();
        } else {
            throw new \Exception("Error Processing Request", 1);
        }
        $this->_hash = sha1($value);
    }

    public function getHash()
    {
        if ($this->_hash === null) {
            $this->hash();
        }
        return $this->_hash;
    }
}
