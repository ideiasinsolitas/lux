<?php
namespace App\DAL\Business\Sales;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Sales\Actions\InvoiceDAOContract;
use App\DAL\Business\Sales\Actions\InvoiceAction;
use App\DAL\Business\Sales\Relationships\InvoiceRelationship;

class InvoiceDAO extends AbstractDAO implements InvoiceDAOContract
{
    use InvoiceAction,
        InvoiceRelationship,
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
            ->select();
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

        if (isset($filters['id'])) {
            $this->builder->where(self::TABLE . '.id', $filters['id']);
        }

        return $this->finish($filters);
    }
}
