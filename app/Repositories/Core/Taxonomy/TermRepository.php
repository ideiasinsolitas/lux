<?php
namespace App\Repositories\Core\Taxonomy\Term;

use App\Models\Core\Taxonomy\Term\Term;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentTermRepository
 * @package App\Repositories\Term
 */
class TermRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Core\Taxonomy\Term\Term';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Term::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getTermsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Term::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedTermsPaginated($per_page = 20)
    {
        return Term::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllTerms($order_by = 'id', $sort = 'asc')
    {
        return Term::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws TermNeedsRolesException
     */
    public function create($input)
    {
        $term = Term::create($input);

        if ($term->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this term. Please try again.');
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
        $term = $this->findOrFail($id);

        if ($term->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this term. Please try again.');
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

        $term = $this->findOrFail($id);
        if ($term->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this term. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $term = $this->findOrFail($id, true);

        try {
            $term->forceDelete();
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
        $term = $this->findOrFail($id);

        if ($term->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this term. Please try again.");
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

        $term = $this->findOrFail($id);
        $term->status = $status;

        if ($term->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this term. Please try again.");
    }
}
