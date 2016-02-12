<?php
namespace App\Repositories\Publishing\ContentManagement;

use Illuminate\Support\Facades\DB;

use App\Repositories\Repository;
use App\Repositories\Publishing\ContentManagement\Actions\PublisherAction;
use App\Repositories\Publishing\ContentManagement\Relationships\PublisherRelationship;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPublisherRepository
 * @package App\Repositories\Publisher
 */
class PublisherRepository extends Repository
{
    use PublisherAction,
        PublisherRelationship;

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

        parent::__construct('publishing_publishers', 'Publisher', $filters);
    }

    protected function getBuilder()
    {
        $relationship_type = DB::raw('\"' . $this->type . '\"');
        return DB::table($this->table)
            ->join('core_translations', function ($q) use ($relationship_type) {
                $q->on('core_translations.translatable_type', $relationship_type)
                    ->where('core_translations.translatable_id', $this->table . '.id');
            })
            ->join('core_types', $this->table . '.type_id', 'core_types.id')
            ->select();
    }

    protected function parseFilters($filters = [], $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }

        if (isset($filters['owner'])) {
            $this->builder->where('core_users.username', $filters['username']);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where($this->table . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where($this->table . '.activity', '>', $filters['activity_greater']);
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
        $now = Carbon::now();
        $input['created'] = $now;
        $input['modified'] = $now;
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
        $input['modified'] = Carbon::now();
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
}
