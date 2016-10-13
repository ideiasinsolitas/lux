<?php
namespace App\DAL\Intel\GeoLocation;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Intel\GeoLocation\Contracts\PlaceDAOContract;
use App\DAL\Intel\GeoLocation\Actions\PlaceAction;
use App\DAL\Intel\GeoLocation\Relationships\PlaceRelationship;

class PlaceDAO extends AbstractDAO implements PlaceDAOContract
{
    use PlaceAction,
        PlaceRelationship,
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
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.type_id',
                self::TABLE . '.address_line',
                self::TABLE . '.address_id',
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
