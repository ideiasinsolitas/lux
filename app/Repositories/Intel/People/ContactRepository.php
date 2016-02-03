<?php
namespace App\Repositories\Package\Contact;

use App\Models\Package\Contact\Contact;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentContactRepository
 * @package App\Repositories\Contact
 */
class ContactRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Contact\Contact';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Contact::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getContactsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Contact::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedContactsPaginated($per_page = 20)
    {
        return Contact::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllContacts($order_by = 'id', $sort = 'asc')
    {
        return Contact::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ContactNeedsRolesException
     */
    public function create($input)
    {
        $contact = Contact::create($input);

        if ($contact->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this contact. Please try again.');
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
        $contact = $this->findOrFail($id);

        if ($contact->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this contact. Please try again.');
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

        $contact = $this->findOrFail($id);
        if ($contact->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this contact. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $contact = $this->findOrFail($id, true);

        try {
            $contact->forceDelete();
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
        $contact = $this->findOrFail($id);

        if ($contact->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this contact. Please try again.");
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

        $contact = $this->findOrFail($id);
        $contact->status = $status;

        if ($contact->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this contact. Please try again.");
    }
}
