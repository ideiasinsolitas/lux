<?php
namespace App\DAL\Core\SiteBuilding;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\SiteBuilding\Actions\MenuAction;
use App\DAL\Core\SiteBuilding\Relationships\MenuRelationship;

class MenuDAO extends AbstractDAO
{
    use MenuAction,
        MenuRelationship;

    public function __construct()
    {
        $this->filters = [
            'sort' => 'name,asc'
        ];
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.parent_id',
                self::TABLE . '.name'
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

    public function createResourceCollection($item_id, $items)
    {
        $collection_id = $this->createCollection($item_id);
        $c = count($items);
        for ($i=0; $i < $c; $i++) {
            $items[$i]['collection_id'] = $collection_id;
        }
        return DB::table('core_collectables')->insert($items);
    }

    public function updateResourceCollection($items, $collection_id)
    {
        $c = count($items);
        for ($i=0; $i < $c; $i++) {
            $items[$i]['collection_id'] = $collection_id;
        }
        return DB::table('core_collectables')->insert($items);
    }

    public function getResourceCollection($collection_id)
    {
        $collection = DB::table('core_collections')
            ->select(
                'core_collections.id',
                'core_collections.node_id',
                'core_collections.type_id',
                'core_collections.order',
                'core_collections.activity',
                'core_collections.created',
                'core_collections.modified'
            )
            ->where('id', $collection_id)
            ->first();

        $resources = DB::table('core_collectables')
            ->join('core_resources', 'core_collectables.collectable_id', '=', 'core_resources.id')
            ->select(
                'core_resources.id',
                'core_resources.type_id',
                'core_resources.node_id',
                'core_resources.url',
                'core_resources.embed',
                'core_resources.activity',
                'core_resources.created',
                'core_resources.modified'
            )
            ->orderBy('core_collectables.order', 'asc')
            ->get();

        $collection->resources = $resources;
        return $collection;
    }
}
