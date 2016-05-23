<?php

namespace App\Http\Controllers\Core\Sys\Resource;

use App\Repositories\Core\Sys\ResourceRepository;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class ResourceController extends Controller
{
    /**
     * [$resources description]
     * @var [type]
     */
    protected $resources;

    protected $handler;

    /**
     * /
     * @param ResourceRepository $resources [description]
     */
    public function __construct(ResponseHandler $handler, ResourceRepository $resources)
    {
        $handler->setPrefix('core.sys');
        $this->handler = $handler;
        $this->resources = $resources;
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [type]                [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->only([
            'id',
            'name',
            'description',
            'url',
            'embed',
            'activity'
            ]);
        $calendar = $request->has('id')
            ? $this->resources
                ->update($input)
            : $this->resources
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
        $resources = $this->resources
            ->getResourcesPaginated(config('core.sys.resource.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($resources);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $resources = $this->resources
            ->getDeactivatedResourcesPaginated(config('core.sys.resource.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $resources = $this->resources
            ->getDeletedResourcesPaginated(config('core.sys.resource.default_per_page'));
            
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
        $calendar = $this->resources
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
        $calendar = $this->resources
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
        $resources = $this->resources
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($resources, 'deleted_many');
    }

    /**
     * @param $id
     * @param RestoreResourceRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->resources
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param MarkResourceRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->resources
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
