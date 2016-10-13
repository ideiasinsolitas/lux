<?php
namespace App\DAL\Business\ProjectManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\DAL\LastInsertIdTrait;
use App\Exceptions\GeneralException;
use App\DAL\Business\ProjectManagement\Contracts\ProjectDAOContract;
use App\DAL\Business\ProjectManagement\Actions\ProjectAction;
use App\DAL\Business\ProjectManagement\Relationships\ProjectRelationship;

class ProjectDAO extends AbstractDAO implements ProjectDAOContract
{
    use ProjectAction,
        ProjectRelationship,
        LastInsertIdTrait,
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
                self::TABLE . '.node_id AS node',
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

        return $this->finish($filters);
    }
}
