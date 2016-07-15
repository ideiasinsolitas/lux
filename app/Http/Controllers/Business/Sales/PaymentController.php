<?php

namespace App\Http\Controllers\Business\SalesPayment;

use App\DAL\Business\SalesPaymentDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class PaymentController extends Controller
{
    /**
     * [$payments description]
     * @var [type]
     */
    protected $payments;

    /**
     * /
     * @param PaymentDAO $payments [description]
     */
    public function __construct(PaymentDAO $payments)
    {
        $this->payments = $payments;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.sales.payment');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $payments = $this->payments->getPaymentsPaginated(config('business.sales.payment.default_per_page'))->items();
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'invoice_id', 'type_id', 'amount']);
        if (isset($input['id'])) {
            $payment = $this->payments->create($input);
        } else {
            $payment = $this->payments->update($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->payments->findOrFail($id, true);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $payment = $this->payments->delete($id);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function deleteMany(DeleteRequest $request)
    {
        $ids = $request->only('ids');
        $payments = $this->payments->deleteMany($var['ids']);
    }

    /**
     * @param $id
     * @param RestorePaymentRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->payments->restore($id);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkPaymentRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->payments->mark($id, $status);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $payments = $this->payments->getPaymentsPaginated();
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $payments = $this->payments->getDeletedPaymentsPaginated();
    }
}
