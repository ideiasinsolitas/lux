<?php
namespace App\Repositories\_Component\_Package\_Name;

use Illuminate\Support\Facades\DB;

use App\Models\_Component\_Package\_Name\_Name;
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
 * Class Eloquent_NameRepository
 * @package App\Repositories\_Name
 */
class _NameRepository extends Repository
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
        $this->mainTable = '_package__names';
        $this->modelPath = 'App\Models\_Component\_Package\_Name';
        $this->type = '_Name';
    }

    /**
     * @param $input
     * @return int
     */
    public function create($input)
    {
        return DB::table('_component__names')
            ->insertGetId($input);
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        return DB::table('_component__names')
            ->update($input)
            ->where('id', $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOrFail($id)
    {
        return _Name::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function get_NamesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return _Name::where('status', '>', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeactivated_NamesPaginated($per_page = 20)
    {
        return _Name::where('activity', 1)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeleted_NamesPaginated($per_page = 20)
    {
        return _Name::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAll_Names($order_by = 'id', $sort = 'asc')
    {
        return _Name::orderBy($order_by, $sort)->get();
    }
}
