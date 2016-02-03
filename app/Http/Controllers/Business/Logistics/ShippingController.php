<?php

namespace App\Http\Controllers\Business\Logistics\Shipping;

use App\Repositories\Business\Logistics\ShippingRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ShippingController extends Controller
{
    /**
     * [$shippings description]
     * @var [type]
     */
    protected $shippings;

    /**
     * /
     * @param ShippingRepository $shippings [description]
     */
    public function __construct(ShippingRepository $shippings)
    {
        $this->shippings = $shippings;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('businnes.logistics.shipping');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $shippings = $this->shippings->getShippingsPaginated(config('businnes.logistics.shipping.default_per_page'))->items();
        $res = [
            'status' => $shippings ? 'OK' : 'error',
            'result' => $shippings,
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
            $shipping = $this->shippings->create($input);
        } else {
            $shipping = $this->shippings->update($input);
        }
        $res = [
            'status' => $shipping ? 'OK' : 'error',
            'message' => trans('alerts.shipping.stored'),
            'result' => $shipping,
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
        $shipping = $this->shippings->findOrFail($id, true);
        $res = [
            'status' => $shipping ? 'OK' : 'error',
            'result' => $shipping,
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
        $shipping = $this->shippings->delete($id);
        $res = [
            'status' => $shipping ? 'OK' : 'error',
            'message' => trans("alerts.shippings.deleted"),
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
        $shippings = $this->shippings->deleteMany($var['ids']);
        $res = [
            'status' => $shippings ? 'OK' : 'error',
            'message' => trans("alerts.shippings.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteShippingRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->shippings->delete($id);
        $res = [
            'status' => $shipping ? 'OK' : 'error',
            'message' => trans("alerts.shippings.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreShippingRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->shippings->restore($id);
        $res = [
            'status' => $shipping ? 'OK' : 'error',
            'message' => trans("alerts.shippings.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkShippingRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->shippings->mark($id, $status);
        $res = [
            'status' => $shipping ? 'OK' : 'error',
            'message' => trans("alerts.shippings.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $shippings = $this->shippings->getShippingsPaginated(25, 0);
        $res = [
            'status' => $shippings ? 'OK' : 'error',
            'result' => $shippings,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $shippings = $this->shippings->getDeletedShippingsPaginated(25);
        $res = [
            'status' => $shippings ? 'OK' : 'error',
            'result' => $shippings,
        ];
        return response()->json($res);
    }
}
