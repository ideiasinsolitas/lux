<?php

namespace App\Http\Controllers\Core\Interaction\Followership;

use App\Repositories\Core\Interaction\FollowershipRepository;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class FollowershipController extends Controller
{
    /**
     * [$followerships description]
     * @var [type]
     */
    protected $followerships;

    protected $handler;
    /**
     * /
     * @param FollowershipRepository $followerships [description]
     */
    public function __construct(ResponseHandler $handler, FollowershipRepository $followerships)
    {
        $handler->setPrefix('core.interaction');
        $this->handler = $handler;
        $this->followerships = $followerships;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $calendar = $request->has('id')
            ? $this->followerships
                ->update($input)
            : $this->followerships
                ->create($input);

        return $this->handler
            ->apiResponse($calendar, 'stored');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $followerships = $this->followerships
            ->getFollowershipsPaginated(config('core.interaction.followership.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($followerships);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $followerships = $this->followerships
            ->getDeactivatedFollowershipsPaginated(config('core.interaction.followership.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $followerships = $this->followerships
            ->getDeletedFollowershipsPaginated(config('core.interaction.followership.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $calendar = $this->followerships
            ->findOrFail($id, true);

        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $calendar = $this->followerships
            ->delete($id);

        return $this->handler
            ->apiResponse($calendar, 'deleted');
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
        $followerships = $this->followerships
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($followerships, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreFollowershipRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->followerships
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkFollowershipRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->followerships
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
