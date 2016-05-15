<?php
namespace App\DAL\Core\Interaction;

use Illuminate\Support\Facades\DB;

use App\DAL\AbstractDAO;
use App\Exceptions\GeneralException;
use App\DAL\Core\Interaction\Actions\CommentAction;
use App\DAL\Core\Interaction\Relationships\CommentRelationship;
use App\DAL\Core\Interaction\Contracts\CommentDAOContract;

class CommentDAO extends AbstractDAO implements CommentDAOContract
{
    use CommentAction,
        CommentRelationship;

    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'created,desc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        $translatable_type = DB::raw('\"' . self::INTERNAL_TYPE . '\"');
        return DB::table(self::TABLE)
            ->join('core_translations', function ($q) use ($translatable_type) {
                return $q->on('core_translations.translatable_type', $translatable_type)
                    ->where('core_translations.translatable_id', self::TABLE . '.' . self::PK);
            })
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TABLE . '.parent_id',
                self::TABLE . '.user_id',
                self::TABLE . '.comment',
                self::TABLE . '.created',
                self::TABLE . '.modified',
                self::TABLE . '.deleted',
                'core_translations.body'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }

        if (isset($filters['lang'])) {
            $this->builder->where('core_translations.translatable_type', self::INTERNAL_TYPE);
            if (isset($filters['pk'])) {
                $this->builder->where('core_translations.translatable_id', $filters['pk']);
            }
            $this->builder->where('core_translations.language', $filters['lang']);
        }
        
        return $this->finish($filters);
    }
}
