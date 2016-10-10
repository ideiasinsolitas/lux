<?php
namespace App\DAL\Publishing\ContentManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\DAL\Publishing\ContentManagement\Contracts\PublisherDAOContract;
use App\DAL\Publishing\ContentManagement\Actions\PublisherAction;
use App\DAL\Publishing\ContentManagement\Relationships\PublisherRelationship;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPublisherDAO
 * @package App\Entitys\Publisher
 */
class PublisherDAO extends AbstractDAO implements PublisherDAOContract
{
    use PublisherAction,
        PublisherRelationship,
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
        $relationship_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table(self::TABLE)
            ->join('core_translations', function ($q) use ($relationship_type) {
                $q->on('core_translations.translatable_type', $relationship_type)
                    ->where('core_translations.translatable_id', self::TABLE . '.id');
            })
            ->join('core_types', self::TABLE . '.type_id', 'core_types.id')
            ->select(
                self::TABLE . '.' . self::PK,
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

        if (isset($filters['owner'])) {
            $this->builder->where('core_users.username', $filters['username']);
        }
        
        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }

        if (isset($filters[self::PK])) {
            $this->builder->where(self::TABLE . '.id', $filters[self::PK]);
        }

        return $this->finish($filters);
    }
}
