<?php
namespace App\Repositories\Package\Embed;

use App\Models\Package\Embed\Embed;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentEmbedRepository
 * @package App\Repositories\Embed
 */
class EmbedRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Embed\Embed';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Embed::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getEmbedsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Embed::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedEmbedsPaginated($per_page = 20)
    {
        return Embed::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllEmbeds($order_by = 'id', $sort = 'asc')
    {
        return Embed::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws EmbedNeedsRolesException
     */
    public function create($input)
    {
        $embed = Embed::create($input);

        if ($embed->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this embed. Please try again.');
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
        $embed = $this->findOrFail($id);

        if ($embed->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this embed. Please try again.');
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

        $embed = $this->findOrFail($id);
        if ($embed->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this embed. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $embed = $this->findOrFail($id, true);

        try {
            $embed->forceDelete();
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
        $embed = $this->findOrFail($id);

        if ($embed->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this embed. Please try again.");
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

        $embed = $this->findOrFail($id);
        $embed->status = $status;

        if ($embed->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this embed. Please try again.");
    }
}
