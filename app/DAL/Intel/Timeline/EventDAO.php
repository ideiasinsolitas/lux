<?php
namespace App\DAL\Intel\Timeline;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Intel\Timeline\Contracts\EventDAOContract;
use App\DAL\Intel\Timeline\Actions\EventAction;
use App\DAL\Intel\Timeline\Relationships\EventRelationship;

class EventDAO extends AbstractDAO implements EventDAOContract
{
    use EventAction,
        EventRelationship,
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
            ->join('intel_calendars', self::TABLE . '.calendar_id', '=', 'intel_calendars.id')
            ->join('core_types', self::TABLE . '.type_id', '=', 'core_types.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.calendar_id',
                'intel_calendars.name AS calendar',
                self::TABLE . '.type_id',
                'core_types.name AS type',
                self::TABLE . '.name',
                self::TABLE . '.description',
                self::TABLE . '.start',
                self::TABLE . '.end',
                self::TABLE . '.repeatable'
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
            $this->builder->where(self::TABLE . '.' . self::PK, $filters[self::PK]);
        }

        return $this->finish($filters);
    }
}
