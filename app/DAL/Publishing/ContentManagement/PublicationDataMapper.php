<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractDataMapper;
use App\DAL\MapperTrait;
use App\DAL\Publishing\ContentManagement\Contracts\PublicationDataMapperContract;
use App\DAL\Publishing\ContentManagement\Contracts\PublicationDAOContract;

class PublicationDataMapper extends AbstractDataMapper implements PublicationDataMapperContract
{
    use DataMapperTrait;

    protected $dao;

    public function __construct(
        PublicationDAOContract $dao,
        IssueDataMapperContract $issues,
        ContentDataMapperContract $contents
    ) {
        $this->dao = $dao;
    }

    public function fetchBySlug($slug)
    {
        $data = $this->publicationDAO->getBuilder()->where('core_translations.slug', $slug)->get();
        return $this->mapEntity($data);
    }

    public function fetchByPublisher($publisher)
    {
        $data = $this->publicationDAO->getBuilder()->where('publishing_publications.publisher_id', $publisher->id)->get();
        return $this->mapCollection($data);
    }
}
