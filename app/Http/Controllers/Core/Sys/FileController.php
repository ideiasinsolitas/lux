<?php

namespace App\Http\Controllers\_Component\_Package\_Name;

use App\Repositories\_Component\_Package\_NameRepository;

use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\ResponseHandler;

class _NameController extends Controller
{
    /**
     * [$_names description]
     * @var [type]
     */
    protected $_names;

    protected $handler;
    /**
     * /
     * @param _NameRepository $_names [description]
     */
    public function __construct(ResponseHandler $handler, _NameRepository $_names)
    {
        $handler->setPrefix('_component._package');
        $this->handler = $handler;
        $this->_names = $_names;
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
            'node_id',
            'type_id',
            'name',
            'description',
            'filepath',
            'filename',
            'mimetype',
            'extension',
            'width',
            'height',
            'activity'
        ]);
        $calendar = $request->has('id')
            ? $this->_names
                ->update($input)
            : $this->_names
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
        $_names = $this->_names
            ->get_NamesPaginated(config('_component._package._name.default_per_page'))
            ->items();
        return $this->handler
            ->apiResponse($_names);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $_names = $this->_names
            ->getDeactivated_NamesPaginated(config('_component._package._name.default_per_page'));
            
        return $this->handler
            ->apiResponse($calendar);
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $_names = $this->_names
            ->getDeleted_NamesPaginated(config('_component._package._name.default_per_page'));
            
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
        $calendar = $this->_names
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
        $calendar = $this->_names
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
        $_names = $this->_names
            ->deleteMany($ids);
            
        return $this->handler
            ->apiResponse($_names, 'deleted_many');
    }

    /**
     * @param $id
     * @param Restore_NameRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $calendar = $this->_names
            ->restore($id);
            
        return $this->handler
            ->apiResponse($calendar, 'restored');
    }

    /**
     * @param $id
     * @param $status
     * @param Mark_NameRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $calendar = $this->_names
            ->mark($id, $status);
            
        return $this->handler
            ->apiResponse($calendar, 'marked');
    }
}
