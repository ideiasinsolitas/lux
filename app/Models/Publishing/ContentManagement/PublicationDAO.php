<?php
namespace App\Repositories\Publishing\ContentManagement;

use Illuminate\Support\Facades\DB;

use App\Repositories\DAO;
use App\Repositories\Publishing\ContentManagement\Actions\PublicationAction;
use App\Repositories\Publishing\ContentManagement\Relationships\PublicationRelationship;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPublicationDAO
 * @package App\Repositories\Publication
 */
class PublicationDAO extends DAO
{
    use PublicationAction,
        PublicationRelationship;

    /**
     * /
     */
    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'date_pub',
            'order' => 'desc'
        ];

        parent::__construct('publishing_publications', 'Publication', $filters);
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
            $builder->where($this->table . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $builder->where($this->table . '.activity', '>', $filters['activity_greater']);
        }
        
        if (isset($filters['lang'])) {
            $builder->where('core_translations.lang', $filters['lang']);
        }

        if (isset($filters['slug'])) {
            $this->builder->where('core_translations.slug', $filters['slug']);
        }

        if (isset($filters['id'])) {
            $this->builder->where($this->table . '.id', $filters['id']);
        }

        return $builder;
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
    public function getByPublisherId($publisher_id)
    {
        return $this->getBuilder()->where('publishing_publications.publisher_id', $id)->get();
    }
}
