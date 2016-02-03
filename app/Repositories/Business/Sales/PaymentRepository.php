<?php
namespace App\Repositories\Package\Payment;

use App\Models\Package\Payment\Payment;
use App\Repositories\Repository;
use App\Repositories\Common\trait;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPaymentRepository
 * @package App\Repositories\Payment
 */
class PaymentRepository extends Repository
{
    use trait;

    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Package\Payment\Payment';
    }

    /**
     * @param $id
     * @param bool $withRoles
     * @return mixed
     * @throws GeneralException
     */
    public function findOrFail($id)
    {
        return Payment::findOrFail($id);
    }

    /**
     * @param $per_page
     * @param string $order_by
     * @param string $sort
     * @param int $status
     * @return mixed
     */
    public function getPaymentsPaginated($per_page = 20, $status = 1, $order_by = 'id', $sort = 'asc')
    {
        return Payment::where('status', $status)->orderBy($order_by, $sort)->paginate($per_page);
    }

    /**
     * @param $per_page
     * @return \Illuminate\Pagination\Paginator
     */
    public function getDeletedPaymentsPaginated($per_page = 20)
    {
        return Payment::onlyTrashed()->paginate($per_page);
    }

    /**
     * @param string $order_by
     * @param string $sort
     * @return mixed
     */
    public function getAllPayments($order_by = 'id', $sort = 'asc')
    {
        return Payment::orderBy($order_by, $sort)->get();
    }

    /**
     * @param $input
     * @param $roles
     * @param $permissions
     * @return bool
     * @throws GeneralException
     * @throws PaymentNeedsRolesException
     */
    public function create($input)
    {
        $payment = Payment::create($input);

        if ($payment->save()) {
            return true;
        }

        throw new GeneralException('There was a problem creating this payment. Please try again.');
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
        $payment = $this->findOrFail($id);

        if ($payment->update($input)) {
            return true;
        }

        throw new GeneralException('There was a problem updating this payment. Please try again.');
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

        $payment = $this->findOrFail($id);
        if ($payment->delete()) {
            return true;
        }

        throw new GeneralException("There was a problem deleting this payment. Please try again.");
    }

    /**
     * @param $id
     * @return boolean|null
     * @throws GeneralException
     */
    public function delete($id)
    {
        $payment = $this->findOrFail($id, true);

        try {
            $payment->forceDelete();
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
        $payment = $this->findOrFail($id);

        if ($payment->restore()) {
            return true;
        }

        throw new GeneralException("There was a problem restoring this payment. Please try again.");
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

        $payment = $this->findOrFail($id);
        $payment->status = $status;

        if ($payment->save()) {
            return true;
        }

        throw new GeneralException("There was a problem updating this payment. Please try again.");
    }
}
