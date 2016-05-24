<?php

namespace App\Http\Controllers\Core\Interaction\Comment;

<<<<<<< HEAD
<<<<<<< HEAD
=======
use App\Repositories\Core\Interaction\CommentDAO;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
use App\Http\Controllers\Controller;

use App\DAL\Core\Interaction\Contracts\CommentDAOContract;
use App\Services\Rest\RestProcessor;

use App\Http\Requests\Generic\StoreRequest;
<<<<<<< HEAD
=======
use App\Repositories\Core\Interaction\CommentRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
use App\Http\Requests\Generic\DeleteRequest;

class CommentController extends Controller
{
    /**
<<<<<<< HEAD
<<<<<<< HEAD
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
     * [$rest description]
     * @var [type]
     */
    protected $rest;

    /**
<<<<<<< HEAD
=======
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
     * [$comments description]
     * @var [type]
     */
    protected $comments;

    /**
     * /
<<<<<<< HEAD
<<<<<<< HEAD
     * @param CommentDAO $comments [description]
     */
    public function __construct(RestProcessor $rest, CommentDAOContract $comments)
    {
        $this->rest = $rest;
=======
     * @param CommentRepository $comments [description]
     */
    public function __construct(CommentRepository $comments)
    {
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
     * @param CommentDAO $comments [description]
     */
<<<<<<< HEAD
    public function __construct(CommentDAO $comments)
    {
=======
    public function __construct(RestProcessor $rest, CommentDAOContract $comments)
    {
        $this->rest = $rest;
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        $this->comments = $comments;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $comments = $this->comments->getAll();
        return $this->rest->process($comments);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        $comments = $this->comments->getCommentsPaginated(config('core.interaction.comment.default_per_page'))->items();
        $res = [
            'status' => $comments ? 'OK' : 'error',
            'result' => $comments,
        ];
        return response()->json($res);
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
        $comments = $this->comments->getAll();
        return $this->rest->process($comments);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
<<<<<<< HEAD
<<<<<<< HEAD
        $input = $request->only(['parent_id', 'user_id', 'commment']);
        if ($request->has('pk')) {
            $comment = $this->comments->update($input, (int) $request->get('pk'));
        } else {
            $comment = $this->comments->insert($input);
        }
        return $this->rest->process($comment);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
        $input = $request->only(['id', 'parent_id', 'user_id', 'commment']);
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
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
        $input = $request->only(['parent_id', 'user_id', 'commment']);
        if ($request->has('pk')) {
            $comment = $this->comments->update($input, (int) $request->get('pk'));
        } else {
            $comment = $this->comments->insert($input);
        }
        return $this->rest->process($comment);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }

    /**
     * Display the specified resource.
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $comment = $this->comments->getOne(['pk' => (int) $pk]);
        return $this->rest->process($comment);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
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
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $comment = $this->comments->getOne(['pk' => (int) $pk]);
        return $this->rest->process($comment);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }

    /**
     * /
<<<<<<< HEAD
<<<<<<< HEAD
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $comment = $this->comments->delete((int) $pk);
        return $this->rest->process($comment);
=======
=======
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
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
        $comments = $this->comments->getCommentsPaginated();
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
        $comments = $this->comments->getDeletedCommentsPaginated();
        $res = [
            'status' => $comments ? 'OK' : 'error',
            'result' => $comments,
        ];
        return response()->json($res);
<<<<<<< HEAD
>>>>>>> 95fd8fdeb03d9e96c89fc62e358cfcd2a7383b39
=======
=======
     * @param  [type]        $pk      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($pk, DeleteRequest $request)
    {
        $comment = $this->comments->delete((int) $pk);
        return $this->rest->process($comment);
>>>>>>> core-develop
>>>>>>> 36b470222e974d45006476ea608af7a71de5bafd
    }
}
