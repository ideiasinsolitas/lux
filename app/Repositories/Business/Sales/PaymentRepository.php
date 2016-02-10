<?php
namespace App\Repositories\Business\Sales;

use App\Models\Business\Sales\Payment;
use App\Repositories\Repository;
use App\Exceptions\GeneralException;

/**
 * Class EloquentPaymentRepository
 * @package App\Repositories\Payment
 */
class PaymentRepository extends Repository
{
    /**
     * /
     */
    public function __construct()
    {
        $this->model = 'App\Models\Business\Sales\Payment';
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
        return Payment::where('activity', 0)->paginate($per_page);
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
}
