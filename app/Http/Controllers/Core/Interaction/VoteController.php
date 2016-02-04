<?php

namespace App\Http\Controllers\Core\Interaction\Vote;

use App\Repositories\Core\Interaction\VoteRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

class VoteController extends Controller
{
    /**
     * [$votes description]
     * @var [type]
     */
    protected $votes;

    /**
     * /
     * @param VoteRepository $votes [description]
     */
    public function __construct(VoteRepository $votes)
    {
        $this->votes = $votes;
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index($page = 1)
    {
        $votes = $this->votes->getVotesPaginated(config('core.interaction.vote.default_per_page'))->items();
        $res = [
            'status' => $votes ? 'OK' : 'error',
            'result' => $votes,
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
            $vote = $this->votes->create($input);
        } else {
            $vote = $this->votes->update($input);
        }
        $res = [
            'status' => $vote ? 'OK' : 'error',
            'message' => trans('alerts.vote.stored'),
            'result' => $vote,
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
        $vote = $this->votes->findOrFail($id, true);
        $res = [
            'status' => $vote ? 'OK' : 'error',
            'result' => $vote,
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
        $vote = $this->votes->delete($id);
        $res = [
            'status' => $vote ? 'OK' : 'error',
            'message' => trans("alerts.votes.deleted"),
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
        $votes = $this->votes->deleteMany($var['ids']);
        $res = [
            'status' => $votes ? 'OK' : 'error',
            'message' => trans("alerts.votes.deleted"),
            'result' => ['ids' => $ids],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param PermanentlyDeleteVoteRequest $request
     * @return mixed
     */
    public function delete($id, PermanentlyDeleteRequest $request)
    {
        $this->votes->delete($id);
        $res = [
            'status' => $vote ? 'OK' : 'error',
            'message' => trans("alerts.votes.deleted_permanently"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreVoteRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->votes->restore($id);
        $res = [
            'status' => $vote ? 'OK' : 'error',
            'message' => trans("alerts.votes.restored"),
            'result' => ['id' => $id],
        ];
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkVoteRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->votes->mark($id, $status);
        $res = [
            'status' => $vote ? 'OK' : 'error',
            'message' => trans("alerts.votes.updated"),
            'result' => ['id' => $id, 'status' => $status],
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $votes = $this->votes->getVotesPaginated(25, 0);
        $res = [
            'status' => $votes ? 'OK' : 'error',
            'result' => $votes,
        ];
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $votes = $this->votes->getDeletedVotesPaginated(25);
        $res = [
            'status' => $votes ? 'OK' : 'error',
            'result' => $votes,
        ];
        return response()->json($res);
    }
}
