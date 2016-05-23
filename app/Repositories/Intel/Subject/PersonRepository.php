<?php
namespace App\Repositories\Package\Person;

use App\Models\Package\Person\Person;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPersonRepository
 * @package App\Repositories\Person
 */
class PersonRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Person\Person';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Person::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPersonsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Person::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPersonsPaginated($per_page = 20)
    {
        return Person::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllPersons($order_by = 'id', $sort = 'asc')
    {
        return Person::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws PersonNeedsRolesException
     */
    public function create($input)
    {
        $person = Person::create($input);

        if ($person->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this person. Please try again.');
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
        $person = $this->findOrFail($id);

        if ($person->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this person. Please try again.');
    }
}
