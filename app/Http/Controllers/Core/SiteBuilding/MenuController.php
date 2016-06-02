<?php

namespace App\Http\Controllers\Core\SiteBuilding\Menu;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\Core\SiteBuilding\MenuRepository;
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
     * @param MenuRepository $menus [description]
     */
    public function __construct(RestProcessorContract $rest, MenuRepository $menus)
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
        $menus = $this->menus->getAll();
        return $this->rest->process($menus);
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only(['id', 'block_id', 'name']);
        if (isset($input['id'])) {
            $menu = $this->menus->create($input);
        } else {
            $menu = $this->menus->update($input);
        }
        return $this->rest->process($menu);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $menu = $this->menus->findOrFail($id, true);
        return $this->rest->process($menu);
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
        return $this->rest->process($menu);
    }
}
