<?php
namespace App\DAL\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\SiteBuilding\Actions\BlockAction;
use App\DAL\Core\SiteBuilding\Relationships\BlockRelationship;

class BlockDAO extends AbstractDAO
{
    use BlockAction,
        BlockRelationship;

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'name,asc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.name',
                self::TABLE . '.area_id'
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
