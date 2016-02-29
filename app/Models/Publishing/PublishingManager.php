<?php

namespace App\Models\Publishing;

class PublishingManager implements DAOManagerContract
{
    protected $namespaces = [];

    public function __construct()
    {
        $this->namespaces = [
            'content' => 'App\Models\Publishing\ContentManagement\ContentDAO',
            'issue' => 'App\Models\Publishing\ContentManagement\IssueDAO',
            'publication' => 'App\Models\Publishing\ContentManagement\PublicationDAO',
            'publisher' => 'App\Models\Publishing\ContentManagement\PublisherDAO',
        ];
    }

    public function getDAO($type)
    {
        $namespace = $this->namespaces[$type];
        return DAOFactory::make($namespace);
    }
}
