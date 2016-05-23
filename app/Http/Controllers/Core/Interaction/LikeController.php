<?php

namespace App\Http\Controllers\Core\Interaction\Like;

use App\Repositories\Core\Interaction\LikeRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class LikeController extends Controller
{
    /**
     * [$likes description]
     * @var [type]
     */
    protected $likes;

    /**
     * /
     * @param LikeRepository $likes [description]
     */
    public function __construct(LikeRepository $likes)
    {
        $this->likes = $likes;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $likes = $this->likes->getLikesPaginated(config('core.interaction.like.default_per_page'))->items();
        
        // $res = SPAService::response($likes);
        $res = [
            'status' => $likes ? 'OK' : 'error',
            'result' => $likes,
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
        $input = $request->only(['user_id', 'likeable_type', 'likeable_id']);
        if (isset($input['id'])) {
            $like = $this->likes->create($input);
        } else {
            $like = $this->likes->update($input);
        }
        
        // $res = SPAService::response($likes, trans('alerts.like.stored'));
        $res = [
            'status' => $like ? 'OK' : 'error',
            'message' => trans('alerts.like.stored'),
            'result' => $like,
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
        $like = $this->likes->findOrFail($id, true);
        $res = [
            'status' => $like ? 'OK' : 'error',
            'result' => $like,
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
        $like = $this->likes->delete($id);
        $res = [
            'status' => $like ? 'OK' : 'error',
            'message' => trans("alerts.likes.deleted"),
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
        $likes = $this->likes->deleteMany($var['ids']);
        $res = [
            'status' => $likes ? 'OK' : 'error',
            'message' => trans("alerts.likes.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteLikeRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->likes->delete($id);
        $res = [
            'status' => $like ? 'OK' : 'error',
            'message' => trans("alerts.likes.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreLikeRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->likes->restore($id);
        $res = [
            'status' => $like ? 'OK' : 'error',
            'message' => trans("alerts.likes.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkLikeRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->likes->mark($id, $status);
        $res = [
            'status' => $like ? 'OK' : 'error',
            'message' => trans("alerts.likes.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $likes = $this->likes->getLikesPaginated();
        $res = [
            'status' => $likes ? 'OK' : 'error',
            'result' => $likes,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $likes = $this->likes->getDeletedLikesPaginated();
        $res = [
            'status' => $likes ? 'OK' : 'error',
            'result' => $likes,
        ];
        return response()->json($res);
    }
}
