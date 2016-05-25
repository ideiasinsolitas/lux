<?php

namespace App\DAL\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\Sys\Actions\ConfigAction;
use App\DAL\Core\Sys\Contracts\ConfigDAOContract;
use App\DAL\Core\Sys\Relationships\ConfigRelationship;

class ConfigDAO extends AbstractDAO implements ConfigDAOContract
{
    use ConfigAction;

    public function __construct()
    {
        $filters = [
            'sort' => 'key,asc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.user_id',
                self::TABLE . '.key',
                self::TABLE . '.value',
                self::TABLE . '.format',
                self::TABLE . '.activity'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['default_config']) && $filters['default_config'] === true) {
            $this->builder->where(self::TABLE . '.user_id', 0)->where(self::TABLE . '.activity', '>', 1);
        }

        if (isset($filters['user_id'])) {
            $this->builder->where(self::TABLE . '.user_id', $filters['user_id']);
        }

        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }

        return $this->finish($filters);
    }

    public function getUserConfig($user_id)
    {
        return $this->parseFilters(['user_id' => $user_id]);
    }

    public function getDefaultConfig()
    {
        return $this->parseFilters(['default_config' => true]);
    }
}
