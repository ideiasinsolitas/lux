<?php
namespace App\Repositories\Publishing\ContentManagement\Content;

use Illuminate\Support\Facades\DB;

use App\Repositories\Repository;
use App\Repositories\Publishing\ContentManagement\Content\Relationships\ContentRelationship;
use App\Repositories\Publishing\ContentManagement\Content\Actions\ContentAction;


use App\Exceptions\GeneralException;

/**
 * Class EloquentContentRepository
 * @package App\Repositories\Content
 */
class ContentRepository extends Repository
{
    use ContentRelationship,
        ContentAction;

    /**
     * /
     */
    public function __construct()
    {
        $this->table = 'publishing_contents';
        $this->type = 'Content';
        $this->filters = [
            'per_page' => 20,
            'sort' => 'date_pub',
            'order' => 'desc'
        ];
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->join()
            ->join()
            ->select();
    }

    protected function parseFilters($builder, $filters = [], $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['owner'])) {
            $this->builder->where('core_users.username', $filters['username']);
        }

        if (isset($filters['vote'])) {
            $this->builder->where('core_votes.name', $filters['vote']);
        }

        if (isset($filters['votes_greater'])) {
            $this->builder->where('vote_count', '>', $filters['votes_greater']);
        }

        if (isset($filters['votes_lesser'])) {
            $this->builder->where('vote_count', '<', $filters['votes_lesser']);
        }

        if (isset($filters['likes_greater'])) {
            $this->builder->where('like_count', '>', $filters['likes_greater']);
        }

        if (isset($filters['likes_lesser'])) {
            $this->builder->where('like_count', '<', $filters['likes_lesser']);
        }

        if (isset($filters['type'])) {
            $this->builder->where('core_types.name', $filters['type']);
        }

        if (isset($filters['activity'])) {
            $this->builder->where($this->table . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where($this->table . '.activity', '>', $filters['activity_greater']);
        }
        
        if (isset($filters['activity_lesser'])) {
            $this->builder->where($this->table . '.activity', '<', $filters['activity_lesser']);
        }
        
        if (isset($filters['lang'])) {
            $this->builder->where('core_translations.lang', $filters['lang']);
        }

        if (isset($filters['slug'])) {
            $this->builder->where('core_translations.slug', $filters['slug']);
        }

        if (isset($filters['id'])) {
            $this->builder->where($this->table . '.id', $filters['id']);
        }

        if (isset($filters['publication_id'])) {
            $this->builder->where($this->table . '.publication_id', $filters['publication_id']);
        }

        if (isset($filters['issue_id'])) {
            $this->builder->where($this->table . '.issue_id', $filters['issue_id']);
        }

        return $this->finish($filters);
    }

    /**
     * @param $input
     * @return int
     */
    public function create($input)
    {
        return DB::table($this->table)
            ->insertGetId($input);
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        return DB::table($this->table)
            ->update($input)
            ->where('id', $id);
    }

    public function getOne($id, $lang)
    {
        return $this->parseFilters(['id' => $id, 'lang' => $lang], false);
    }

    public function getOneBySlug($slug)
    {
        return $this->parseFilters(['slug' => $slug], false);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $statust
     * @return mixed
     */
    public function getPublishedPaginated()
    {
        return $this->parseFilters(['activity' => 5]);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPendingPaginated()
    {
        return $this->parseFilters(['activity' => 4]);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getDraftPaginated($filters = [])
    {
        return $this->parseFilters(['activity' => 3]);
    }

    public function getByPublicationId($publication_id)
    {
        return $this->parseFilters(['publication_id' => $publication_id]);
    }

    public function getByIssueId($issue_id)
    {
        return $this->parseFilters(['issue_id' => $issue_id]);
    }

    public function getByType($type)
    {
        return $this->parseFilters(['type' => $type]);
    }
}
