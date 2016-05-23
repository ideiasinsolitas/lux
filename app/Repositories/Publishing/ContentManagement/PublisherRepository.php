<?php
namespace App\Repositories\Publishing\ContentManagement\Publisher;

use Illuminate\Support\Facades\DB;

use App\Models\Publishing\ContentManagement\Publisher\Publisher;
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
 * Class EloquentPublisherRepository
 * @package App\Repositories\Publisher
 */
class PublisherRepository extends Repository
{
    use Activity,
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
        $this->table = 'publishing_publishers';
        $this->type = 'Publisher';
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

    private function getBuilder()
    {
        return DB::table($this->table)
            ->join()
            ->join()
            ;
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
    public function getFullPublishedPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return DB::table($this->table)->where('activity', '>', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }
}
