<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractDataMapper;
use App\DAL\AbstractEntity;
use App\DAL\MapperTrait;
use App\DAL\Publishing\ContentManagement\Contracts\ContentDataMapperContract;
use App\DAL\Publishing\ContentManagement\Contracts\ContentDAOContract;

class ContentDataMapper extends AbstractDataMapper implements ContentDataMapperContract
{
    use DataMapperTrait;

    protected $contentDAO;

    public function __construct(ContentDAOContract $contentDAO)
    {
        $this->contentDAO = $contentDAO;
    }

    public function fetchById($id, $lang)
    {
        $data = $this->contentDAO->parseFilters(['id' => $id, 'lang' => $lang], false);
        return $this->createEntity($data);
    }

    public function fetchBySlug($slug)
    {
        $data = $this->contentDAO->parseFilters(['slug' => $slug], false);
        return $this->createEntity($data);
    }

    public function fetchPublished()
    {
        $data = $this->contentDAO->parseFilters(['activity' => 5]);
        return $this->createEntityCollection($data);
    }

    public function fetchPending()
    {
        $data = $this->contentDAO->parseFilters(['activity' => 4]);
        return $this->createEntityCollection($data);
    }

    public function fetchDraft($per_page)
    {
        $data = $this->contentDAO->parseFilters(['activity' => 3]);
        return $this->createEntityCollection($data);
    }

    public function fetchByPublicationId($publication_id)
    {
        $data = $this->contentDAO->parseFilters(['publication_id' => $publication_id]);
        return $this->createEntityCollection($data);
    }

    public function fetchByIssueId($issue_id)
    {
        $data = $this->contentDAO->parseFilters(['issue_id' => $issue_id]);
        return $this->createEntityCollection($data);
    }

    public function fetchByType($type)
    {
        $data = $this->contentDAO->parseFilters(['type' => $type]);
        return $this->createEntityCollection($data);
    }
}
