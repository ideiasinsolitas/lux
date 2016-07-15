<?php

namespace App\Http\Controllers\Business\Logistics;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Business\Logistics\ShippingDAO;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ShippingController extends Controller
{
    /**
     * [$shippings description]
     * @var [shipping]
     */
    protected $shippings;

    /**
     * /
     * @param ShippingDAO $shippings [description]
     */
    public function __construct(ShippingDAO $shippings)
    {
        $this->shippings = $shippings;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [shipping]        [description]
     */
    public function index()
    {
        $shippings = $this->shippings->getAll(request()->get("filters"));
        return $shippings;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [shipping]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['order_id', 'type_id', 'tracking_ref', 'activity']);
        if ($request->has('pk')) {
            $shipping = $this->shippings->update($input, (int) $request->get('pk'));
        } else {
            $input['created'] = Carbon::now();
            $shipping = $this->shippings->insert($input);
        }
        return $shipping;
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $shipping = $this->shippings->getOne(['pk' => (int) $pk]);
        return $shipping;
    }

    /**
     * /
     * @param  [shipping]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [shipping]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $shipping = $this->shippings->delete((int) $pk);
        return $shipping;
    }
}
