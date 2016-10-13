<?php

namespace App\DAL;

abstract class DAOFacade
{
    protected static $allowed = [];

    protected $dao;

    public static function getInstance($name)
    {
        if (isset(self::$allowed[$name])) {
            $class = self::$allowed[$name];
            return new self(new $class);
        }
        throw new \Exception("Error Processing Request", 1);
    }

    protected function __construct($dao)
    {
        $this->dao = $dao;
    }

    public function __call($name, $arguments)
    {
        if (method_exists($this, $name)) {
            return call_user_func_array(array($this, $name), $arguments);
        }
    }
}
