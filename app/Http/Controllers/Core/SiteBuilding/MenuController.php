<?php

namespace App\Http\Controllers\Core\SiteBuilding\Menu;

use App\Repositories\Core\SiteBuilding\MenuRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

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
    public function __construct(MenuRepository $menus)
    {
        $this->menus = $menus;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.site_building.menu');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $menus = $this->menus->getMenusPaginated(config('core.site_building.menu.default_per_page'))->items();
        $res = [
            'status' => $menus ? 'OK' : 'error',
            'result' => $menus,
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
            $menu = $this->menus->create($input);
        } else {
            $menu = $this->menus->update($input);
        }
        $res = [
            'status' => $menu ? 'OK' : 'error',
            'message' => trans('alerts.menu.stored'),
            'result' => $menu,
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
        $menu = $this->menus->findOrFail($id, true);
        $res = [
            'status' => $menu ? 'OK' : 'error',
            'result' => $menu,
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
        $menu = $this->menus->delete($id);
        $res = [
            'status' => $menu ? 'OK' : 'error',
            'message' => trans("alerts.menus.deleted"),
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
        $menus = $this->menus->deleteMany($var['ids']);
        $res = [
            'status' => $menus ? 'OK' : 'error',
            'message' => trans("alerts.menus.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteMenuRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->menus->delete($id);
        $res = [
            'status' => $menu ? 'OK' : 'error',
            'message' => trans("alerts.menus.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreMenuRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->menus->restore($id);
        $res = [
            'status' => $menu ? 'OK' : 'error',
            'message' => trans("alerts.menus.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkMenuRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->menus->mark($id, $status);
        $res = [
            'status' => $menu ? 'OK' : 'error',
            'message' => trans("alerts.menus.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $menus = $this->menus->getMenusPaginated(25);
        $res = [
            'status' => $menus ? 'OK' : 'error',
            'result' => $menus,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $menus = $this->menus->getDeletedMenusPaginated(25);
        $res = [
            'status' => $menus ? 'OK' : 'error',
            'result' => $menus,
        ];
        return response()->json($res);
    }
}
