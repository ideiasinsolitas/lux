<?php
namespace App\Repositories\Business\Logistics\Shipping;

use App\Models\Business\Logistics\Shipping\Shipping;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentShippingRepository
 * @package App\Repositories\Shipping
 */
class ShippingRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Logistics\Shipping\Shipping';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Shipping::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getShippingsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Shipping::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedShippingsPaginated($per_page = 20)
    {
        return Shipping::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllShippings($order_by = 'id', $sort = 'asc')
    {
        return Shipping::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws ShippingNeedsRolesException
     */
    public function create($input)
    {
        $shipping = Shipping::create($input);

        if ($shipping->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this shipping. Please try again.');
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
        $shipping = $this->findOrFail($id);

        if ($shipping->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this shipping. Please try again.');
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

        $shipping = $this->findOrFail($id);
        if ($shipping->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this shipping. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $shipping = $this->findOrFail($id, true);

        try {
            $shipping->forceDelete();
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
        $shipping = $this->findOrFail($id);

        if ($shipping->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this shipping. Please try again.");
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

        $shipping = $this->findOrFail($id);
        $shipping->status = $status;

        if ($shipping->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this shipping. Please try again.");
    }
}
