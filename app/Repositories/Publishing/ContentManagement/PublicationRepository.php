<?php
namespace App\Repositories\Publishing\ContentManagement\Publication;

use Illuminate\Support\Facades\DB;

use App\Models\Publishing\ContentManagement\Publication\Publication;
use App\Repositories\Repository;

use App\Repositories\Common\Activity;
use App\Repositories\Common\Collaborative;
use App\Repositories\Common\Likeable;
use App\Repositories\Common\Ownable;
use App\Repositories\Common\UserTaggable;
use App\Repositories\Common\Votable;

use App\Exceptions\GeneralException;

/**
 * Class EloquentPublicationRepository
 * @package App\Repositories\Publication
 */
class PublicationRepository extends Repository
{
    use Activity,
        Collaborative,
        Likeable,
        Ownable,
        UserTaggable,
        Votable;

    /**
     * /
     */
    public function __construct()
    {
        $this->table = 'publishing_publications';
        $this->type = 'Publication';
    }

    /**
     * @param $input
     * @return int
     */
    public function create($input)
    {
        return DB::table($this->table)
            ->insertGetId($input);
    }

    /**
     * @param $id
     * @param $input
     * @return mixed
     */
    public function update($id, $input)
    {
        return DB::table($this->table)
            ->update($input)
            ->where('id', $id);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findOne($id)
    {
        return DB::table($this->table)
            ->select()
            ->where($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPublicationsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)
            ->where('activity', '>', $status)
            ->orderBy($order_by, $sort)
            ->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeactivatedPublicationsPaginated($per_page = 20)
    {
        return DB::table($this->table)
            ->where('activity', 1)
            ->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPublicationsPaginated($per_page = 20)
    {
        return DB::table($this->table)
            ->where('activity', 0)
            ->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllPublications($order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)
            ->orderBy($order_by, $sort)
            ->get();
    }
}
