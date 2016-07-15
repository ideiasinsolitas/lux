<?php
namespace App\DAL\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Core\SiteBuilding\Contracts\AreaDAOContract;
use App\DAL\Core\SiteBuilding\Actions\AreaAction;
use App\DAL\Core\SiteBuilding\Relationships\AreaRelationship;

class AreaDAO extends AbstractDAO implements AreaDAOContract
{
    use AreaAction,
        AreaRelationship,
        DAOTrait;

    public function __construct()
    {
        $this->filters = [
            'sort' => 'name,asc'
        ];
        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.name',
                self::TABLE . '.activity'
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

        return $this->finish($filters);
    }
}
