<?php
namespace App\Repositories\Business\Sales;

use Illuminate\Support\Facades\DB;

use App\Repositories\DAO;
use App\Exceptions\GeneralException;
use App\Repositories\Business\Sales\Actions\InvoiceAction;
use App\Repositories\Business\Sales\Relationships\InvoiceRelationship;

class InvoiceDAO extends DAO
{
    use InvoiceAction,
        InvoiceRelationship;

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

        parent::__construct('business_invoices', 'Invoice', $filters);
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
