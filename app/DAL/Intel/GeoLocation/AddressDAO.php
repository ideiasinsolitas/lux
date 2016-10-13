<?php
namespace App\DAL\Intel\GeoLocation;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Intel\GeoLocation\Contracts\AddressDAOContract;
use App\DAL\Intel\GeoLocation\Actions\AddressAction;
use App\DAL\Intel\GeoLocation\Relationships\AddressRelationship;

class AddressDAO extends AbstractDAO implements AddressDAOContract
{
    use AddressAction,
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
            ->join('intel_districts AS t1', self::TABLE . '.district_id', '=', 't1.id')
            ->join('intel_cities AS t2', self::TABLE . '.city_id', '=', 't2.id')
            ->join('intel_provinces AS t3', 't2.province_id', '=', 't3.id')
            ->join('intel_countries AS t4', 't3.country_id', '=', 't4.id')
            ->leftJoin('intel_coordinates AS t5', self::TABLE . '.coordinate_id', '=', 't5.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.name',
                self::TABLE . '.street',
                self::TABLE . '.number',
                't1.name AS district',
                't2.name AS city',
                't3.name AS province',
                't3.code AS province_code',
                't4.name AS country',
                't4.code AS country_code',
                self::TABLE . '.zipcode',
                't5.lat',
                't5.lon'
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
