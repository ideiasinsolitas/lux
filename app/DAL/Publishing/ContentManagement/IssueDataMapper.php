<?php

namespace App\DAL\Publishing\ContentManagement;

use App\DAL\AbstractDataMapper;

class IssueDataMapper extends AbstractDataMapper
{
    public function __construct(IssueDAOContract $dao)
    {
        $this->dao = $dao;
    }

    public function fetchByIdAndLang($id, $lang)
    {
        $builder = $this->issueDAO->getBuilder();
        $data = $this->issueDAO->parseFilters($builder, ['id' => $id, 'lang' => $lang], false);
        return $this->createEntity($data);
    }

    public function fetchBySlug($slug)
    {
        $data = $this->issueDAO->getBuilder()->where('core_translations.slug', $slug)->get();
        return $this->createEntity($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetchById($id)
    {
        $data = $this->issueDAO->getBuilder()
            ->where('publishing_issues.id', $id);
        return $this->createEntity($data);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $statust
     * @return mixed
     */
    public function fetchPublished(array $filters = array())
    {
        $builder = $this
            ->issueDAO
            ->getBuilder()
            ->where(self::TABLE . '.activity', 5);
        $data = $this
            ->issueDAO
            ->parseFilters($builder, $filters);
        return $this->createEntityCollection($data);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function fetchByPublicationId($publication_id, $filters = [])
    {
        $builder = $this
            ->issueDAO
            ->getBuilder()
            ->where(self::TABLE . '.publication_id', $publication_id);
        $data = $this
            ->issueDAO
            ->parseFilters($builder, $filters);
        return $this->createEntityCollection($data);
    }
}
