<?php
namespace App\Repositories\Publishing\ContentManagement\Issue;

use Illuminate\Support\Facades\DB;

use App\Models\Publishing\ContentManagement\Issue\Issue;
use App\Repositories\Repository;

use App\Repositories\Common\Activity;
use App\Repositories\Common\Collaborative;
use App\Repositories\Common\Likeable;
use App\Repositories\Common\OwnerTaggable;
use App\Repositories\Common\Ownable;

use App\Exceptions\GeneralException;

/**
 * Class EloquentIssueRepository
 * @package App\Repositories\Issue
 */
class IssueRepository extends Repository
{
    use Activity,
        Collaborative,
        Likeable,
        OwnerTaggable,
        Ownable;

    /**
     * /
     */
    public function __construct()
    {
        $this->table = 'publishing_issues';
        $this->type = 'Issue';
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
        
        if (isset($filters['activity'])) {
            $this->builder->where($this->table . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where($this->table . '.activity', '>', $filters['activity_greater']);
        }
        
        if (isset($filters['type'])) {
            $this->builder->where('core_types.name', $filters['type']);
        }

        if (isset($filters['term'])) {
            $this->builder->where('core_terms.name', $filters['term']);
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
        $builder = $this->getBuilder()->where($this->table . '.id', $id);
        return $this->parseFilters($builder, ['lang' => $lang], false);
    }

    public function getOneBySlug($slug)
    {
        return $this->getBuilder()->where('core_translations.slug', $slug)->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOne($id)
    {
        return $this->getBuilder()
            ->where('publishing_issues.id', $id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $statust
     * @return mixed
     */
    public function getPublishedPaginated($filters = [])
    {
        $builder = $this->getBuilder()->where($this->table . '.activity', 5);
        return $this->parseFilters($builder, $filters);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getByPublicationId($publication_id, $filters = [])
    {
        $builder = $this->getBuilder()->where($this->table . '.publication_id', $publication_id);
        return $this->parseFilters($builder, $filters);
    }
}
