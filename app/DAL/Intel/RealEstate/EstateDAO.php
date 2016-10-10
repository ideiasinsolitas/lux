<?php
namespace App\DAL\Intel\RealEstate;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Intel\RealEstate\Contracts\EstateDAOContract;
use App\DAL\Intel\RealEstate\Actions\EstateAction;
use App\DAL\Intel\RealEstate\Relationships\EstateRelationship;

class EstateDAO extends AbstractDAO implements EstateDAOContract
{
    use EstateAction,
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
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.place_id',
                self::TABLE . '.type_id',
                self::TABLE . '.area',
                self::TABLE . '.rooms',
                self::TABLE . '.suites',
                self::TABLE . '.parking_spots',
                self::TABLE . '.price',
                self::TABLE . '.charges',
                self::TABLE . '.taxes',
                self::TABLE . '.additional_info',
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
