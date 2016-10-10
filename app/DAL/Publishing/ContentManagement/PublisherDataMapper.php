<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractDataMapper;

class PublisherDataMapper extends AbstractDataMapper
{

    public function __construct(PublisherDAOContract $publisherDAO)
    {
        $this->publisherDAO = $publisherDAO;
    }

    public function fetchByIdAndLang($id, $lang)
    {
        return $this->publisherDAO->parseFilters(['id' => $id, 'lang' => $lang], false);
    }

    public function fetchBySlug($slug)
    {
        return $this->publisherDAO->parseFilters(['slug' => $slug], false);
    }
}
