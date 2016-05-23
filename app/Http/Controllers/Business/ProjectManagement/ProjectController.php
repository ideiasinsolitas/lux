<?php

namespace App\Http\Controllers\Business\ProjectManagement\Project;

use App\Repositories\Business\ProjectManagementProjectRepository;

use App\Http\Requests\Generic\CreateRequest;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\EditRequest;
use App\Http\Requests\Generic\UpdateRequest;
use App\Http\Requests\Generic\DeleteRequest;

use App\Services\Format;

class ProjectController extends Controller
{
    /**
     * [$projects description]
     * @var [type]
     */
    protected $projects;

    /**
     * /
     * @param ProjectRepository $projects [description]
     */
    public function __construct(ProjectRepository $projects)
    {
        $this->projects = $projects;
    }

    /**
     * /
     * @return [type] [description]
     */
    public function app()
    {
        return view('business.project_management.project');
    }

    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public function index()
    {
        $projects = $this->projects
            ->getProjectsPaginated(config('business.project_management.project.default_per_page'))
            ->items();
        $res = [
            'status' => $projects ? 'OK' : 'error',
            'result' => $projects,
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
        $input = $request->only(['id', 'node_id', 'name', 'description', 'activity']);
        $project = isset($input['id'])
            ? $this->projects->create($input)
            : $this->projects->update($input);
    }

    /**
     * Display the specified resource.
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projects->findOrFail($id, true);
    }

    /**
     * /
     * @param  [type]        $id      [description]
     * @param  DeleteRequest $request [description]
     * @return [type]                 [description]
     */
    public function destroy($id, DeleteRequest $request)
    {
        $project = $this->projects->delete($id);
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
        $projects = $this->projects->deleteMany($ids['ids']);
    }

    /**
     * @param $id
     * @param RestoreProjectRequest $request
     * @return mixed
     */
    public function restore($id, UpdateRequest $request)
    {
        $this->projects->restore($id);
    }

    /**
     * @param $id
     * @param $status
     * @param MarkProjectRequest $request
     * @return mixed
     */
    public function mark($id, $status, UpdateRequest $request)
    {
        $this->projects->mark($id, $status);
    }

    /**
     * @return mixed
     */
    public function deactivated()
    {
        $projects = $this->projects->getProjectsPaginated();
    }

    /**
     * @return mixed
     */
    public function deleted()
    {
        $projects = $this->projects->getDeletedProjectsPaginated();
    }
}
