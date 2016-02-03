<?php

namespace App\Http\Controllers\Core\Interaction\Friendship;

use App\Repositories\Core\Interaction\FriendshipRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class FriendshipController extends Controller
{
    /**
     * [$friendships description]
     * @var [type]
     */
    protected $friendships;

    /**
     * /
     * @param FriendshipRepository $friendships [description]
     */
    public function __construct(FriendshipRepository $friendships)
    {
        $this->friendships = $friendships;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('core.interaction.friendship');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $friendships = $this->friendships->getFriendshipsPaginated(config('core.interaction.friendship.default_per_page'))->items();
        $res = [
            'status' => $friendships ? 'OK' : 'error',
            'result' => $friendships,
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
            $friendship = $this->friendships->create($input);
        } else {
            $friendship = $this->friendships->update($input);
        }
        $res = [
            'status' => $friendship ? 'OK' : 'error',
            'message' => trans('alerts.friendship.stored'),
            'result' => $friendship,
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
        $friendship = $this->friendships->findOrFail($id, true);
        $res = [
            'status' => $friendship ? 'OK' : 'error',
            'result' => $friendship,
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
        $friendship = $this->friendships->delete($id);
        $res = [
            'status' => $friendship ? 'OK' : 'error',
            'message' => trans("alerts.friendships.deleted"),
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
        $friendships = $this->friendships->deleteMany($var['ids']);
        $res = [
            'status' => $friendships ? 'OK' : 'error',
            'message' => trans("alerts.friendships.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteFriendshipRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->friendships->delete($id);
        $res = [
            'status' => $friendship ? 'OK' : 'error',
            'message' => trans("alerts.friendships.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreFriendshipRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->friendships->restore($id);
        $res = [
            'status' => $friendship ? 'OK' : 'error',
            'message' => trans("alerts.friendships.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkFriendshipRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->friendships->mark($id, $status);
        $res = [
            'status' => $friendship ? 'OK' : 'error',
            'message' => trans("alerts.friendships.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $friendships = $this->friendships->getFriendshipsPaginated(25, 0);
        $res = [
            'status' => $friendships ? 'OK' : 'error',
            'result' => $friendships,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $friendships = $this->friendships->getDeletedFriendshipsPaginated(25);
        $res = [
            'status' => $friendships ? 'OK' : 'error',
            'result' => $friendships,
        ];
        return response()->json($res);
    }
}
