<?php
namespace App\Models\Core\Sys;

use Illuminate\Support\Facades\DB;

use App\Models\AbstractDAO;
use App\Exceptions\GeneralException;
use App\Models\Core\Sys\Actions\ConfigAction;
use App\Models\Core\Sys\Contracts\ConfigDAOContract;
use App\Models\Core\Sys\Relationships\ConfigRelationship;

class ConfigDAO extends AbstractDAO implements ConfigDAOContract
{
    use ConfigAction;

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'date_pub,desc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
//            ->leftJoin('users', 'users.id', '=', self::TABLE. '.' . self::PK)
            ->select('id', 'user_id', 'key', 'value', 'format', 'activity');
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
