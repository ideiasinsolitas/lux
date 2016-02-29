<?php
namespace App\Repositories\Business\ProjectManagement;

use Illuminate\Support\Facades\DB;

use App\Repositories\DAO;
use App\Exceptions\GeneralException;
use App\Repositories\Business\ProjectManagement\Actions\ProjectAction;
use App\Repositories\Business\ProjectManagement\Relationships\ProjectRelationship;

class ProjectDAO extends DAO
{
    use ProjectAction,
        ProjectRelationship;

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

        parent::__construct('business_projects', 'Project', $filters);
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->select(
                $this->table . '.id',
                $this->table . '.node_id',
                $this->table . '.name',
                $this->table . '.description',
                $this->table . '.activity'
            );
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
