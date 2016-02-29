<?php

namespace App\Models\Intel;

class IntelManager implements DAOManagerContract
{
    protected $namespaces = [];

    public function __construct()
    {
        $this->namespaces = [
            'content' => 'App\Models\Intel\\DAO',
            'issue' => 'App\Models\Intel\\DAO',
            'publication' => 'App\Models\Intel\\DAO',
            'publisher' => 'App\Models\Intel\\DAO',
        ];
    }

    public function getDAO($type)
    {
        $namespace = $this->namespaces[$type];
        return DAOFactory::make($namespace);
    }
}
