<?php
namespace App\Repositories\Package\Project;

use App\Models\Package\Project\Project;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentProjectRepository
 * @package App\Repositories\Project
 */
class ProjectRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Project\Project';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Project::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getProjectsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Project::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedProjectsPaginated($per_page = 20)
    {
        return Project::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllProjects($order_by = 'id', $sort = 'asc')
    {
        return Project::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ProjectNeedsRolesException
     */
    public function create($input)
    {
        $project = Project::create($input);

        if ($project->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this project. Please try again.');
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
        $project = $this->findOrFail($id);

        if ($project->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this project. Please try again.');
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

        $project = $this->findOrFail($id);
        if ($project->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this project. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $project = $this->findOrFail($id, true);

        try {
            $project->forceDelete();
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
        $project = $this->findOrFail($id);

        if ($project->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this project. Please try again.");
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

        $project = $this->findOrFail($id);
        $project->status = $status;

        if ($project->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this project. Please try again.");
    }
}
