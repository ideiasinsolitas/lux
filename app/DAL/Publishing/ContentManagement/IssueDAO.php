<?php
namespace App\DAL\Publishing\ContentManagement;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\DAL\DAOTrait;

use App\DAL\Publishing\ContentManagement\Contracts\IssueDAOContract;
use App\DAL\Publishing\ContentManagement\Actions\IssueAction;
use App\DAL\Publishing\ContentManagement\Relationships\IssueRelationship;

use App\Exceptions\GeneralException;

class IssueDAO extends AbstractDAO implements IssueDAOContract
{
    use IssueAction,
        IssueRelationship,
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
        return DB::table(self::TABLE)
            ->join()
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TABLE . '.publication_id'
                self::TABLE . '.activity',
                self::TABLE . '.date_pub',
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
            $this->builder->where(self::TABLE . '.activity', $filters['activity']);
        }
        
        if (isset($filters['activity_greater'])) {
            $this->builder->where(self::TABLE . '.activity', '>', $filters['activity_greater']);
        }
        
        if (isset($filters['type'])) {
            $this->builder->where('core_types.name', $filters['type']);
        }

        if (isset($filters['term'])) {
            $this->builder->where('core_terms.name', $filters['term']);
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

        return $this->finish($filters);
    }
}
