<?php
namespace App\DAL\Core\Taxonomy;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\Taxonomy\Contracts\TermDAOContract;
use App\DAL\Core\Taxonomy\Actions\TermAction;
use App\DAL\Core\Taxonomy\Relationships\TermRelationship;

class TermDAO extends AbstractDAO implements TermDAOContract
{
    use TermAction;
    use TermRelationship;

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => self::PK . ',asc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        $translatable_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table(self::TABLE)
            ->join(self::TRANSLATION_TABLE, function ($q) use ($translatable_type) {
                return $q->on(self::TRANSLATION_TABLE . '.translatable_type', $translatable_type)
                    ->where(self::TRANSLATION_TABLE . '.translatable_id', self::TABLE . '.' . self::PK);
            })
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TRANSLATION_TABLE . '.name'
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

        if (isset($filters['lang'])) {
            $this->builder->where(self::TRANSLATION_TABLE . '.translatable_type', self::INTERNAL_TYPE);
            if (isset($filters['pk'])) {
                $this->builder->where(self::TRANSLATION_TABLE . '.translatable_id', $filters['pk']);
            }
            $this->builder->where(self::TRANSLATION_TABLE . '.language', $filters['lang']);
        }
        return $this->finish($filters);
    }
}
