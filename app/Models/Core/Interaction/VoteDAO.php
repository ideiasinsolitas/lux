<?php
namespace App\Models\Core\Interaction;

use Illuminate\Support\Facades\DB;

use App\Models\AbstractDAO;
use App\Exceptions\GeneralException;
use App\Models\Core\Interaction\Actions\VoteAction;
use App\Models\Core\Interaction\Relationships\VoteRelationship;

class VoteDAO extends AbstractDAO
{
    use VoteAction,
        VoteRelationship;

    /**
     * /
     */
    public function __construct()
    {
        $filters = [
            'per_page' => 20,
            'sort' => 'votable_id,desc'
        ];

        parent::__construct($filters);
    }

    public function getBuilder()
    {
        return DB::table(self::TABLE)
            ->select(
                self::TABLE . '.user_id',
                self::TABLE . '.votable_type',
                self::TABLE . '.votable_id'
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
            ->update()
            ->where(self::PK, $id);
    }
}
