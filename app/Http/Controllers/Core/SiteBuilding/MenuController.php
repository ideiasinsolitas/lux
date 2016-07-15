<?php

namespace App\Http\Controllers\Core\SiteBuilding;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\SiteBuilding\MenuDAO;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;
use App\Services\Rest\RestProcessorContract;

class MenuController extends Controller
{
    /**
     * [$menus description]
     * @var [type]
     */
    protected $menus;

    /**
     * /
     * @param MenuDAO $menus [description]
     */
    public function __construct(RestProcessorContract $rest, MenuDAO $menus)
    {
        $this->rest = $rest;
        $this->menus = $menus;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $menus = $this->menus->getAll(request()->get("filters"));
        return $menus;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'block_id', 'name']);
        if ($request->has('id')) {
            $menu = $this->menus->create($input);
        } else {
            $menu = $this->menus->update($input, (int) $request->get('pk'));
        }
        return $menu;
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $menu = $this->menus->getOne($id);
        return $menu;
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $menu = $this->menus->delete($id);
        return $menu;
    }
}
