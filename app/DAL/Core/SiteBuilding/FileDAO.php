<?php
namespace App\DAL\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\SiteBuilding\Actions\FileAction;
use App\DAL\Core\SiteBuilding\Relationships\FileRelationship;

class FileDAO extends AbstractDAO
{
    use FileAction,
        FileRelationship;

    public function __construct()
    {
        $this->filters = [
            'sort' => 'created,desc'
        ];
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join('core_types', self::TABLE . '.type_id', '=', 'core_types.id')
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                'core_types.name AS type',
                'core_types.class',
                self::TABLE . '.name',
                self::TABLE . '.description',
                self::TABLE . '.filepath',
                self::TABLE . '.filename',
                self::TABLE . '.mimetype',
                self::TABLE . '.extension',
                self::TABLE . '.width',
                self::TABLE . '.height',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.modified',
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
