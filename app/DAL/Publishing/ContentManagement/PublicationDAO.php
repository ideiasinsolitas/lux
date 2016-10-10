<?php
namespace App\DAL\Publishing\ContentManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\DAL\Publishing\ContentManagement\Contracts\PublicationDAOContract;
use App\Exceptions\GeneralException;

use App\DAL\Publishing\ContentManagement\Actions\PublicationAction;
use App\DAL\Publishing\ContentManagement\Relationships\PublicationRelationship;

/**
 * Class EloquentPublicationDAO
 * @package App\Entitys\Publication
 */
class PublicationDAO extends AbstractDAO implements PublicationDAOContract
{
    use PublicationAction,
        PublicationRelationship,
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
            ->join()
            ->join()
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TABLE . '.type_id',
                self::TABLE . '.publisher_id',
                self::TABLE . '.theme_view',
                self::TABLE . '.frequency',
                self::TABLE . '.activity',
                self::TABLE . '.created',
                self::TABLE . '.modified',
                self::TABLE . '.deleted'
            );
    }

    public function parseFilters($builder, $filters = [], $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['activity'])) {
            $builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }
        
        if (isset($filters['lang'])) {
            $builder->where('core_translations.lang', $filters['lang']);
        }

        if (isset($filters['slug'])) {
            $this->builder->where('core_translations.slug', $filters['slug']);
        }

        if (isset($filters[self::PK])) {
            $this->builder->where(self::TABLE . '.' . self::PK, $filters[self::PK]);
        }

        return $builder;
    }
}
