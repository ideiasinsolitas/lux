<?php

namespace App\Http\Controllers\Business\SalesPayment;

use App\Repositories\Business\SalesPaymentRepository;

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
     * @param PaymentRepository $payments [description]
     */
    public function __construct(PaymentRepository $payments)
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
        $res = [
            'status' => $payments ? 'OK' : 'error',
            'result' => $payments,
        ];
        return response()->json($res);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['']);
        if (isset($input['id'])) {
            $payment = $this->payments->create($input);
        } else {
            $payment = $this->payments->update($input);
        }
        $res = [
            'status' => $payment ? 'OK' : 'error',
            'message' => trans('alerts.payment.stored'),
            'result' => $payment,
        ];
        return response()->json($res);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $payment = $this->payments->findOrFail($id, true);
        $res = [
            'status' => $payment ? 'OK' : 'error',
            'result' => $payment,
        ];
        return response()->json($res);
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
        $res = [
            'status' => $payment ? 'OK' : 'error',
            'message' => trans("alerts.payments.deleted"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
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
        $res = [
            'status' => $payments ? 'OK' : 'error',
            'message' => trans("alerts.payments.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestorePaymentRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->payments->restore($id);
        $res = [
            'status' => $payment ? 'OK' : 'error',
            'message' => trans("alerts.payments.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
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
        $res = [
            'status' => $payment ? 'OK' : 'error',
            'message' => trans("alerts.payments.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $payments = $this->payments->getPaymentsPaginated(25);
        $res = [
            'status' => $payments ? 'OK' : 'error',
            'result' => $payments,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $payments = $this->payments->getDeletedPaymentsPaginated(25);
        $res = [
            'status' => $payments ? 'OK' : 'error',
            'result' => $payments,
        ];
        return response()->json($res);
    }
}
