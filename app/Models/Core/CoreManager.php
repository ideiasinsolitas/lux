<?php

namespace App\Models\Core;

class CoreManager implements DAOManagerContract
{
    protected $namespaces = [];

    public function __construct()
    {
        $this->namespaces = [
            'content' => 'App\Models\Core\\DAO',
            'issue' => 'App\Models\Core\\DAO',
            'publication' => 'App\Models\Core\\DAO',
            'publisher' => 'App\Models\Core\\DAO',
        ];
    }

    public function getDAO($type)
    {
        $namespace = $this->namespaces[$type];
        return DAOFactory::make($namespace);
    }
}
