<?php

namespace App\Http\Controllers\Business\Logistics\Shipping;

use App\Repositories\Business\Logistics\ShippingRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

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
    public function index()
    {
        $shippings = $this->shippings
            ->getShippingsPaginated(config('businnes.logistics.shipping.default_per_page'))
            ->items();
        return Format::apiResponse($shippings);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['']);
        $shipping = isset($input['id'])
            ? $this->shippings->create($input)
            : $this->shippings->update($input);
        return Format::apiResponse($shipping, trans('alerts.shipping.stored'));
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $shipping = $this->shippings->findOrFail($id, true);
        return Format::apiResponse($shipping);
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
        return Format::apiResponse($shipping, trans('alerts.shipping.deleted'));
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
        return Format::apiResponse($shipping, trans('alerts.shipping.deleted_many'));
    }

    /**
     * @param $id
     * @param RestoreShippingRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $shipping = $this->shippings->restore($id);
        return Format::apiResponse($shipping, trans('alerts.shipping.restored'));
    }

    /**
     * @param $id
     * @param $status
     * @param MarkShippingRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $shipping = $this->shippings->mark($id, $status);
        return Format::apiResponse($shipping, trans('alerts.shipping.marked'));
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $shippings = $this->shippings->getShippingsPaginated(25);
        return Format::apiResponse($shippings);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $shippings = $this->shippings->getDeletedShippingsPaginated(25);
        return Format::apiResponse($shippings);
    }
}
