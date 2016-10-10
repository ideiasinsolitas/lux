<?php
namespace App\DAL\Business\Store;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Store\Contracts\ProductDAOContract;
use App\DAL\Business\Store\Actions\ProductAction;
use App\DAL\Business\Store\Relationships\ProductRelationship;

class ProductDAO extends AbstractDAO implements ProductDAOContract
{
    use ProductAction,
        ProductRelationship,
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
            ->join('', self::TABLE . '', '', '')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TABLE . '.shop_id',
                self::TABLE . '.in_stock',
                self::TABLE . '.price',
                self::TABLE . '.weight',
                self::TABLE . '.height',
                self::TABLE . '.width',
                self::TABLE . '.depth',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.modified',
                self::TABLE . '.deleted'
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
