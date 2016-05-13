<?php

namespace App\Http\Controllers\Core\SiteBuilding\Area;

use App\Repositories\Core\SiteBuilding\AreaDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class AreaController extends Controller
{
    /**
     * [$areas description]
     * @var [type]
     */
    protected $areas;

    /**
     * /
     * @param AreaDAO $areas [description]
     */
    public function __construct(AreaDAO $areas)
    {
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
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function save(StoreRequest $request)
    {
        $input = $request->only(['id', 'name', 'activity']);
        if (isset($input['id'])) {
            $area = $this->areas->create($input);
        } else {
            $area = $this->areas->update($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $area = $this->areas->getOne($id);
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
    }
}
