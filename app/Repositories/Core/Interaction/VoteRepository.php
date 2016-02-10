<?php
namespace App\Repositories\Core\Interaction\Vote;

use App\Models\Core\Interaction\Vote\Vote;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentVoteRepository
 * @package App\Repositories\Vote
 */
class VoteRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Interaction\Vote';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Vote::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getVotesPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Vote::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedVotesPaginated($per_page = 20)
    {
        return Vote::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllVotes($order_by = 'id', $sort = 'asc')
    {
        return Vote::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws VoteNeedsRolesException
     */
    public function create($input)
    {
        $vote = Vote::create($input);

        if ($vote->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this vote. Please try again.');
    }
}
