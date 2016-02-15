<?php
namespace App\Repositories\Business\Logistics;

use Illuminate\Support\Facades\DB;

use App\Repositories\Repository;
use App\Exceptions\GeneralException;
use App\Repositories\Business\Logistics\Actions\ShippingAction;
use App\Repositories\Business\Logistics\Relationships\ShippingRelationship;

class ShippingRepository extends Repository
{
    use ShippingAction,
        ShippingRelationship;

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

        parent::__construct('business_shippings', 'Shipping', $filters);
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->join('core_types', $this->table . '.type_id', 'core_types.id')
            ->select(
                $this->table . '.id',
                $this->table . '.order_id',
                $this->table . '.type_id',
                $this->table . '.tracking_ref',
                $this->table . '.activity',
                $this->table . '.created',
                $this->table . '.shipped',
                $this->table . '.delivered',
                DB::raw('core_types.name AS type')
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
            ->update($input)
            ->where('id', $id);
    }
}
