<?php
namespace App\Models\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\Models\AbstractDAO;
use App\Exceptions\GeneralException;
use App\Models\Core\SiteBuilding\Actions\ResourceAction;
use App\Models\Core\SiteBuilding\Relationships\ResourceRelationship;

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
            'per_page' => 20,
            'sort' => 'date_pub',
            'order' => 'desc'
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

    public function create(array $input)
    {
        return DB::table(self::TABLE)
            ->insertGetId($input);
    }

    public function update(array $input, $pk)
    {
        return DB::table(self::TABLE)
            ->update()
            ->where(self::PK, $pk);
    }
}
