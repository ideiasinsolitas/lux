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
        $this->filters = [
            'sort' => 'created,desc'
        ];
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::PK,
                self::TABLE . '.node_id',
                self::TABLE . '.parent_id',
                self::TABLE . '.user_id',
                self::TABLE . '.commentable_type',
                self::TABLE . '.commentable_id',
                self::TABLE . '.comment',
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
                
        return $this->finish($filters);
    }
}
