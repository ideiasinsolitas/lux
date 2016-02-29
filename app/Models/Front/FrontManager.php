<?php

namespace App\Models\Front;

class FrontManager implements DAOManagerContract
{
    protected $namespaces = [];

    public function __construct()
    {
        $this->namespaces = [
            'content' => 'App\Models\Front\\DAO',
            'issue' => 'App\Models\Front\\DAO',
            'publication' => 'App\Models\Front\\DAO',
            'publisher' => 'App\Models\Front\\DAO',
        ];
    }

    public function getDAO($type)
    {
        $namespace = $this->namespaces[$type];
        return DAOFactory::make($namespace);
    }
}
