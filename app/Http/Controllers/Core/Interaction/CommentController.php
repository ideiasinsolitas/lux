<?php

namespace App\Http\Controllers\Core\Interaction\Comment;

use App\Repositories\Core\Interaction\CommentRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class CommentController extends Controller
{
    /**
     * [$comments description]
     * @var [type]
     */
    protected $comments;

    /**
     * /
     * @param CommentRepository $comments [description]
     */
    public function __construct(CommentRepository $comments)
    {
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $comments = $this->comments->getCommentsPaginated(config('core.interaction.comment.default_per_page'))->items();
        $res = [
            'status' => $comments ? 'OK' : 'error',
            'result' => $comments,
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
            $comment = $this->comments->create($input);
        } else {
            $comment = $this->comments->update($input);
        }
        $res = [
            'status' => $comment ? 'OK' : 'error',
            'message' => trans('alerts.comment.stored'),
            'result' => $comment,
            'event' => 'comment-stored'
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
        $comment = $this->comments->findOrFail($id, true);
        $res = [
            'status' => $comment ? 'OK' : 'error',
            'result' => $comment,
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
        $comment = $this->comments->delete($id);
        $res = [
            'status' => $comment ? 'OK' : 'error',
            'message' => trans("alerts.comments.deleted"),
            'result' => ['id' => $id],
            'event' => 'comment-deleted'
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
        $comments = $this->comments->deleteMany($var['ids']);
        $res = [
            'status' => $comments ? 'OK' : 'error',
            'message' => trans("alerts.comments.deleted"),
            'result' => ['ids' => $ids],
            'event' => 'comment-deleted-many'
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteCommentRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->comments->delete($id);
        $res = [
            'status' => $comment ? 'OK' : 'error',
            'message' => trans("alerts.comments.deleted_permanently"),
            'result' => ['id' => $id],
            'event' => 'comment-deleted-permanently'
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreCommentRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->comments->restore($id);
        $res = [
            'status' => $comment ? 'OK' : 'error',
            'message' => trans("alerts.comments.restored"),
            'result' => ['id' => $id],
            'event' => 'comment-restored'
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkCommentRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->comments->mark($id, $status);
        $res = [
            'status' => $comment ? 'OK' : 'error',
            'message' => trans("alerts.comments.updated"),
            'result' => ['id' => $id, 'status' => $status],
            'event' => 'comment-marked'
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $comments = $this->comments->getCommentsPaginated(25, 0);
        $res = [
            'status' => $comments ? 'OK' : 'error',
            'result' => $comments,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $comments = $this->comments->getDeletedCommentsPaginated(25);
        $res = [
            'status' => $comments ? 'OK' : 'error',
            'result' => $comments,
        ];
        return response()->json($res);
    }
}
