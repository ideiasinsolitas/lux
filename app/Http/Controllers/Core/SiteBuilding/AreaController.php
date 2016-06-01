<?php

namespace App\Http\Controllers\Core\SiteBuilding\Area;

use App\Repositories\Core\SiteBuilding\AreaRepository;
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
     * @param AreaRepository $areas [description]
     */
    public function __construct(RestProcessorContract $rest, AreaRepository $areas)
    {
        $this->rest = $rest;
        $this->areas = $areas;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.site_building.area');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $areas = $this->areas->getAll();
        return $this->rest->process($areas);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'name', 'activity']);
        if (isset($input['id'])) {
            $area = $this->areas->create($input);
        } else {
            $area = $this->areas->update($input);
        }
        return $this->rest->process($area);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $area = $this->areas->findOrFail($id, true);
        return $this->rest->process($area);
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
        return $this->rest->process($area);
    }

    public function addBlock($area_id, StoreRequest $request)
    {
        $block_id = $request->get('block_id');
        return $this->rest->process($area);
    }

    public function removeBlock($area_id, $block_id)
    {
        return $this->rest->process($area);
    }
}
