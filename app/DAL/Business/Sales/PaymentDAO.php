<?php
namespace App\DAL\Business\Sales;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Sales\Contracts\PaymentDAOContract;
use App\DAL\Business\Sales\Actions\PaymentAction;
use App\DAL\Business\Sales\Relationships\PaymentRelationship;

class PaymentDAO extends AbstractDAO implements PaymentDAOContract
{
    use PaymentAction,
        PaymentRelationship,
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
            ->join()
            ->join()
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.invoice_id',
                self::TABLE . '.type_id',
                self::TABLE . '.amount',
                self::TABLE . '.created'
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
