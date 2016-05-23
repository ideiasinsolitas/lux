<?php
namespace App\Repositories\Business\Store;

use App\Models\Business\Store\Customer;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentCustomerRepository
 * @package App\Repositories\Customer
 */
class CustomerRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Store\Customer';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getCustomersPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Customer::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedCustomersPaginated($per_page = 20)
    {
        return Customer::where('activity', 0)->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllCustomers($order_by = 'id', $sort = 'asc')
    {
        return Customer::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws CustomerNeedsRolesException
     */
    public function create($input)
    {
        $customer = Customer::create($input);

        if ($customer->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this name. Please try again.');
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
        $customer = $this->findOrFail($id);

        if ($customer->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this name. Please try again.');
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

        $customer = $this->findOrFail($id);
        if ($customer->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this name. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $customer = $this->findOrFail($id, true);

        try {
            $customer->forceDelete();
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
        $customer = $this->findOrFail($id);

        if ($customer->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this name. Please try again.");
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

        $customer = $this->findOrFail($id);
        $customer->status = $status;

        if ($customer->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this name. Please try again.");
    }
}
