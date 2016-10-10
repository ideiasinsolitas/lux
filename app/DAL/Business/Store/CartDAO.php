<?php
namespace App\DAL\Business\Store;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Store\Contracts\CartDAOContract;
use App\DAL\Business\Store\Actions\CartAction;
use App\DAL\Business\Store\Relationships\CartRelationship;

class CartDAO implements CartDAOContract
{
    public function __construct()
    {
        $this->filters = [
            'sort' => self::PK . ',desc',
        ];

        $this->builder = $this->getBuilder();
    }

    protected function getBuilder()
    {
        return DB::table($this->table)
            ->join('core_users', self::TABLE . '.customer_id', '=', 'core_users.id')
            ->join('business_products', self::TABLE . '.product_id', '=', 'business_products.id')
            ->join('business_shops', 'business_products.shop_id', '=', 'business_products.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.customer_id',
                self::TABLE . '.product_id',
                'core_users.username',
                'core_users.email',
                'business_products.name AS product',
                'business_products.description AS product_description',
                'business_products.price',
                'business_shops.name AS shop',
                self::TABLE . '.quantity'
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

        if (isset($filters[self::PK])) {
            $this->builder->where($this->table . '.id', $filters[self::PK]);
        }

        return $this->finish($filters);
    }
}
