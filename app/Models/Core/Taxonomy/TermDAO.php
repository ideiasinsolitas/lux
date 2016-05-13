<?php
namespace App\Models\Core\Taxonomy;

use Illuminate\Support\Facades\DB;

use App\Models\AbstractDAO;
use App\Exceptions\GeneralException;
use App\Models\Core\Taxonomy\Actions\TermAction;
use App\Models\Core\Taxonomy\Relationships\TermRelationship;

class TermDAO extends AbstractDAO
{
    use TermAction,
        TermRelationship;

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'date_pub',
            'order' => 'desc'
        ];

        parent::__construct('core_terms', 'Term', $filters);
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->join('core_translations', '', '=', '')
            ->select(
                self::TABLE . '.',
                'core_translations.'
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
            $this->builder->where('core_translations.language', $filters['lang']);
        }

        return $this->finish($filters);
    }
}
