<?php
namespace App\Repositories\Intel\Subject\Fact;

use Illuminate\Support\Facades\DB;

use App\Models\Intel\Subject\Fact\Fact;
use App\Repositories\Repository;

use App\Repositories\Common\Activity;
use App\Repositories\Common\Collaborative;
use App\Repositories\Common\Collectable;
use App\Repositories\Common\Commentable;
use App\Repositories\Common\Likeable;
use App\Repositories\Common\OwnerTaggable;
use App\Repositories\Common\Ownable;
use App\Repositories\Common\Typed;
use App\Repositories\Common\UserTaggable;
use App\Repositories\Common\Votable;

use App\Exceptions\GeneralException;

/**
 * Class EloquentFactRepository
 * @package App\Repositories\Fact
 */
class FactRepository extends Repository
{
    use Activity,
        Builder,
        Collaborative,
        Collectable,
        Likeable,
        OwnerTaggable,
        Ownable,
        Typed,
        UserTaggable,
        Votable;

    /**
     * /
     */
    public function __construct()
    {
        $this->table = 'intel_facts';
        $this->type = 'Fact';
    }

    /**
     * @param $input
     * @return int
     */
    public function create($input)
    {
        return DB::table('intel_facts')
            ->insertGetId($input);
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        return DB::table('intel_facts')
            ->update($input)
            ->where('id', $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return Fact::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getFactsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Fact::where('activity', '>', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeactivatedFactsPaginated($per_page = 20)
    {
        return Fact::where('activity', 1)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedFactsPaginated($per_page = 20)
    {
        return Fact::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllFacts($order_by = 'id', $sort = 'asc')
    {
        return Fact::orderBy($order_by, $sort)->get();
    }
}
