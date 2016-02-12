<?php
namespace App\Repositories\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\Repositories\Repository;
use App\Exceptions\GeneralException;
use App\Repositories\Core\SiteBuilding\Actions\ResourceAction;
use App\Repositories\Core\SiteBuilding\Relationships\ResourceRelationship;

class ResourceRepository extends Repository
{
    use ResourceAction,
        ResourceRelationship;

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

        parent::__construct('core_resources', 'Resource', $filters);
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->join()
            ->join()
            ->select();
    }

    protected function parseFilters($filters = [], $defaults = true)
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
     * @param
     * @param
     * @return mixed
     */
    public function update($id, $input)
    {
        $input['modified'] = Carbon::now();
        return DB::table($this->table)
            ->update()
            ->where('id', $id);
    }
}
