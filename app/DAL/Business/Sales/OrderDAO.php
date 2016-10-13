<?php
namespace App\DAL\Business\Sales;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Sales\Contracts\OrderDAOContract;
use App\DAL\Business\Sales\Actions\OrderAction;
use App\DAL\Business\Sales\Relationships\OrderRelationship;

class OrderDAO extends AbstractDAO implements OrderDAOContract
{
    use OrderAction,
        OrderRelationship,
        DAOTrait;

    /**
     * /
     */
    public function __construct()
    {
        $this->filters = [
            'sort' => self::PK . ',desc',
        ];

        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join('users AS u', self::TABLE . '.customer_id', '=', 'u.id')
            ->join('users AS u2', self::TABLE . '.seller_id', '=', 'u2.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.customer_id',
                'u.email AS customer_email',
                self::TABLE . '.seller_id',
                'u2.email AS seller_email',
                self::TABLE . '.payment_method',
                self::TABLE . '.shipping_method',
                self::TABLE . '.price',
                self::TABLE . '.taxes',
                self::TABLE . '.extra_cost',
                self::TABLE . '.shipping_cost',
                self::TABLE . '.created',
                self::TABLE . '.closed'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }

        if (isset($filters[self::PK])) {
            $this->builder->where(self::TABLE . '.id', $filters[self::PK]);
        }

        return $this->finish($filters);
    }
}
