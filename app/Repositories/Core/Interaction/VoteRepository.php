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
        $this->model = 'App\Models\Core\Interaction\Vote\Vote';
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
        return Vote::onlyTrashed()->paginate($per_page);
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

    /**
     * @param $id
     * @param $input
     * @param $roles
     * @return bool
     * @throws GeneralException
     */
    public function update($id, $input)
    {
        $vote = $this->findOrFail($id);

        if ($vote->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this vote. Please try again.');
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function destroy($id)
    {
        if (auth()->id() == $id) {
            throw new GeneralException("You can not delete yourself.");
        }

        $vote = $this->findOrFail($id);
        if ($vote->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this vote. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $vote = $this->findOrFail($id, true);

        try {
            $vote->forceDelete();
        } catch (\Exception $e) {
            throw new GeneralException($e->getMessage());
        }
    }

    /**
     * @param $id
     * @return bool
     * @throws GeneralException
     */
    public function restore($id)
    {
        $vote = $this->findOrFail($id);

        if ($vote->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this vote. Please try again.");
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws GeneralException
     */
    public function mark($id, $status)
    {
        if (auth()->id() == $id && ($status == 0 || $status == 2)) {
            throw new GeneralException("You can not do that to yourself.");
        }

        $vote = $this->findOrFail($id);
        $vote->status = $status;

        if ($vote->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this vote. Please try again.");
    }
}
