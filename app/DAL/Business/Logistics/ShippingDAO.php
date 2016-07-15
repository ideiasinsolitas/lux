<?php
namespace App\DAL\Business\Logistics;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Logistics\Contracts\ShippingDAOContract;
use App\DAL\Business\Logistics\Actions\ShippingAction;
use App\DAL\Business\Logistics\Relationships\ShippingRelationship;

class ShippingDAO extends AbstractDAO implements ShippingDAOContract
{
    use ShippingAction,
        ShippingRelationship,
        DAOTrait;

    /**
     * /
     */
    public function __construct()
    {
        $this->filters = [
            'sort' => 'created,desc',
        ];

        $this->builder = $this->getBuilder();
    }

    /**
     * /
     * @return [type] [description]
     */
    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join('core_types', self::TABLE . '.type_id', '=', 'core_types.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.order_id',
                self::TABLE . '.type_id',
                self::TABLE . '.tracking_ref',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.shipped',
                self::TABLE . '.delivered',
                DB::raw('core_types.name AS type')
            );
    }

    /**
     * /
     * @param  array   $filters  [description]
     * @param  boolean $defaults [description]
     * @return [type]            [description]
     */
    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults === true) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }

        if (isset($filters['pk'])) {
            $this->builder->where(self::TABLE . '.' . self::PK, $filters['pk']);
        }

        return $this->finish($filters);
    }
}
