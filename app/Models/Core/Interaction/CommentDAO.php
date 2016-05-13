<?php
namespace App\Models\Core\Interaction;

use Illuminate\Support\Facades\DB;

use App\Models\AbstractDAO;
use App\Exceptions\GeneralException;
use App\Models\Core\Interaction\Actions\CommentAction;
use App\Models\Core\Interaction\Relationships\CommentRelationship;
use App\Models\Core\Interaction\Contracts\CommentDAOContract;

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
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.' . self::TABLE,
                self::TABLE . '.node_id',
                self::TABLE . '.parent_id',
                self::TABLE . '.user_id',
                self::TABLE . '.comment',
                self::TABLE . '.created'
            );
    }

    protected function parseFilters(array $filters = array(), $defaults = true)
    {
        if ($defaults) {
            $filters = array_merge($this->filters, $filters);
        }
        
        return $this->finish($filters);
    }

    public function create(array $input)
    {
        return DB::table(self::TABLE)
            ->insertGetId($input);
    }

    public function update(array $input, $pk)
    {
        return DB::table(self::TABLE)
            ->update($input)
            ->where(self::PK, $pk);
    }
}
