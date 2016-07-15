<?php

namespace App\Http\Controllers\Core\SiteBuilding;

use Illuminate\Routing\Controller;

use App\DAL\Core\SiteBuilding\AreaDAO;
use App\Services\Rest\RestProcessorContract;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class AreaController extends Controller
{
    protected $rest;

    /**
     * [$areas description]
     * @var [type]
     */
    protected $areas;

    /**
     * /
     * @param AreaDAO $areas [description]
     */
    public function __construct(RestProcessorContract $rest, AreaDAO $areas)
    {
        $this->rest = $rest;
        $this->areas = $areas;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $areas = $this->areas->getAll(request()->get("filters"));
        return $areas;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'name', 'activity']);
        if ($request->has('id')) {
            $area = $this->areas->create($input);
        } else {
            $area = $this->areas->update($input, (int) $request->get('pk'));
        }
        return $area;
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($pk)
    {
        $area = $this->areas->getOne(['pk' => (int) $pk]);
        return $area;
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $area = $this->areas->delete($id);
        return $area;
    }
}
