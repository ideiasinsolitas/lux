<?php
namespace App\DAL\Publishing\ContentManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;
use App\Exceptions\GeneralException;

use App\DAL\Publishing\ContentManagement\Contracts\ContentDAOContract;
use App\DAL\Publishing\ContentManagement\Relationships\ContentRelationship;
use App\DAL\Publishing\ContentManagement\Actions\ContentAction;

/**
 * Class EloquentContentDAO
 * @package App\Entitys\Content
 */
class ContentDAO extends AbstractDAO implements ContentDAOContract
{
    use ContentRelationship,
        ContentAction,
        DAOTrait;

    public function __construct()
    {
        $this->filters = [
            'sort' => self::PK . ',desc',
        ];

        $this->builder = $this->getBuilder();
    }

    public function getBuilder()
    {
        $relationship_type = DB::raw("\"" . self::INTERNAL_TYPE . "\"");
        return DB::table(self::TABLE)
            ->join('core_translations', function ($q) use ($relationship_type) {
                $q->on('core_translations.translatable_type', '=', $relationship_type)
                    ->where('core_translations.translatable_id', '=', self::TABLE . '.id');
            })
            ->join('core_types', self::TABLE . '.type_id', '=', 'core_types.id')
            ->join('core_likes', function ($q) {
                $q->on('', '=', $relationship_type)
                   ->where('', '=', '');
            })
            ->join('core_votes', function ($q) {
                $q->on('', '=', $relationship_type)
                   ->where('', '=', '');
            })
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TABLE . '.parent_id',
                self::TABLE . '.type_id',
                self::TABLE . '.publication_id',
                self::TABLE . '.issue_id',
                self::TABLE . '.activity',
                self::TABLE . '.date_pub',
                self::TABLE . '.created',
                self::TABLE . '.modified',
                self::TABLE . '.deleted'
            );
    }

    public function parseFilters($filters = [], $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        if (isset($filters['owner'])) {
            $this->builder->where('core_users.username', $filters['username']);
        }

        if (isset($filters['vote'])) {
            $this->builder->where('core_votes.name', $filters['vote']);
        }

        if (isset($filters['votes_greater'])) {
            $this->builder->where('vote_count', '>', $filters['votes_greater']);
        }

        if (isset($filters['votes_lesser'])) {
            $this->builder->where('vote_count', '<', $filters['votes_lesser']);
        }

        if (isset($filters['likes_greater'])) {
            $this->builder->where('like_count', '>', $filters['likes_greater']);
        }

        if (isset($filters['likes_lesser'])) {
            $this->builder->where('like_count', '<', $filters['likes_lesser']);
        }

        if (isset($filters['type'])) {
            $this->builder->where('core_types.name', $filters['type']);
        }

        if (isset($filters['activity'])) {
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }
        
        if (isset($filters['activity_lesser'])) {
            $this->builder->where(self::TABLE . '.activity', '<', $filters['activity_lesser']);
        }
        
        if (isset($filters['lang'])) {
            $this->builder->where('core_translations.lang', $filters['lang']);
        }

        if (isset($filters['slug'])) {
            $this->builder->where('core_translations.slug', $filters['slug']);
        }

        if (isset($filters[self::PK])) {
            $this->builder->where(self::TABLE . '.' . self::PK, $filters[self::PK]);
        }

        if (isset($filters['publication_id'])) {
            $this->builder->where(self::TABLE . '.publication_id', $filters['publication_id']);
        }

        if (isset($filters['issue_id'])) {
            $this->builder->where(self::TABLE . '.issue_id', $filters['issue_id']);
        }

        return $this->finish($filters);
    }
}
