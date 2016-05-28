<?php
namespace App\DAL\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\SiteBuilding\Actions\ResourceAction;
use App\DAL\Core\SiteBuilding\Relationships\ResourceRelationship;

class ResourceDAO extends AbstractDAO
{
    use ResourceAction,
        ResourceRelationship;

    /**
     * /
     */
    public function __construct()
    {
        $filters = [
            'sort' => 'created,desc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.type_id',
                self::TABLE . '.node_id',
                self::TABLE . '.name',
                self::TABLE . '.description',
                self::TABLE . '.url',
                self::TABLE . '.embed',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.deleted'
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
