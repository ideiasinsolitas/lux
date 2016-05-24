<?php

namespace App\Http\Controllers\Business\Logistics\Shipping;

use App\Repositories\Business\BusinessManager;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\ResponseHandler;

class ShippingController extends Controller
{
    /**
     * [$shippings description]
     * @var [type]
     */
    protected $shippings;

    protected $handler;
    /**
     * /
     * @param BusinessManager $shippings [description]
     */
    public function __construct(ResponseHandler $handler, BusinessManager $manager)
    {
        $handler->setPrefix('business.logistics');
        $this->handler = $handler;
        $this->shippings = $manager->getDAO('shippings');
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $shipping = $request->has('id')
            ? $this->shippings
                ->update($input)
            : $this->shippings
                ->create($input);

        return $this->handler
            ->apiResponse($shipping, 'stored');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $shippings = $this->shippings
            ->getPaginated(config('business.logistics.shipping.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($shippings);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $shippings = $this->shippings
            ->getDeactivatedPaginated(config('business.logistics.shipping.default_per_page'));
            
        return $this->handler
            ->apiResponse($shippings);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $shippings = $this->shippings
            ->getDeletedPaginated(config('business.logistics.shipping.default_per_page'));
            
        return $this->handler
            ->apiResponse($shippings);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $shipping = $this->shippings
            ->findOne($id, true);

        return $this->handler
            ->apiResponse($shipping);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $shipping = $this->shippings
            ->delete($id);

        return $this->handler
            ->apiResponse($shipping, 'deleted');
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
        $shippings = $this->shippings
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($shippings, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreShippingRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $shipping = $this->shippings
            ->restore($id);
            
        return $this->handler
            ->apiResponse($shipping, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkShippingRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $shipping = $this->shippings
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($shipping, 'marked');
    }
}
