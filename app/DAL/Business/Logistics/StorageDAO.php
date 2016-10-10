<?php

namespace App\DAL\Business\Logistics;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\Logistics\Contracts\StorageDAOContract;
use App\DAL\Business\Logistics\Actions\StorageAction;
use App\DAL\Business\Logistics\Relationships\StorageRelationship;

class StorageDAO extends AbstractDAO implements StorageDAOContract
{
    use StorageAction,
        StorageRelationship,
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

    /**
     * /
     * @return [type] [description]
     */
    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.place_id',
                self::TABLE . '.name',
                self::TABLE . '.description'
            );
    }

    /**
     * /
     * @param  array   $filters  [description]
     * @param  boolean $defaults [description]
     * @return [type]            [description]
     */
    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }

        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity'] ? 1 : 0);
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
