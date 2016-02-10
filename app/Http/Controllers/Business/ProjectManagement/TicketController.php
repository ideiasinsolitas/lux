<?php

namespace App\Http\Controllers\Business\ProjectManagement\Ticket;

use App\Repositories\Business\ProjectManagementTicketRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class TicketController extends Controller
{
    /**
     * [$tickets description]
     * @var [type]
     */
    protected $tickets;

    /**
     * /
     * @param TicketRepository $tickets [description]
     */
    public function __construct(TicketRepository $tickets)
    {
        $this->tickets = $tickets;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.project_management.ticket');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $tickets = $this->tickets->getTicketsPaginated(config('business.project_management.ticket.default_per_page'))->items();
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
            $ticket = $this->tickets->create($input);
        } else {
            $ticket = $this->tickets->update($input);
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $ticket = $this->tickets->findOrFail($id, true);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $ticket = $this->tickets->delete($id);
        $res = [
            'status' => $ticket ? 'OK' : 'error',
            'message' => trans("alerts.tickets.deleted"),
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
        $tickets = $this->tickets->deleteMany($var['ids']);
        return response()->json($res);
    }

    /**
     * @param $id
     * @param RestoreTicketRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->tickets->restore($id);
        return response()->json($res);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkTicketRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->tickets->mark($id, $status);
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $tickets = $this->tickets->getTicketsPaginated(25);
        return response()->json($res);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $tickets = $this->tickets->getDeletedTicketsPaginated(25);
        return response()->json($res);
    }
}
