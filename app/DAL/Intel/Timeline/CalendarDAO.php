<?php
namespace App\DAL\Intel\Timeline;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Intel\Timeline\Contracts\CalendarDAOContract;
use App\DAL\Intel\Timeline\Actions\CalendarAction;
use App\DAL\Intel\Timeline\Relationships\CalendarRelationship;

class CalendarDAO extends AbstractDAO implements CalendarDAOContract
{
    use CalendarAction,
        CalendarRelationship,
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
                self::TABLE . '.node_id',
                self::TABLE . '.name',
                self::TABLE . '.description'
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
