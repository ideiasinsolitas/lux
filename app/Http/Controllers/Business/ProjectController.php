<?php

namespace App\Http\Controllers\Business;

use Illuminate\Routing\Controller;
use Carbon\Carbon;

use App\DAL\UnitOfWork;
use App\DAL\ObjectStorage;
use App\Services\Rest\Response;

use App\DAL\Business\ProjectManagement\Contracts\ProjectDataMapperContract;
use App\DAL\Business\ProjectManagement\Project;

use App\Http\Controllers\DefaultControllerTrait;
use App\Http\Requests\Generic\StoreRequest;
use App\Http\Requests\Generic\DeleteRequest;

class ProjectController extends Controller
{
    use DefaultControllerTrait;

    /**
     * [$mapper description]
     * @var [project]
     */
    protected $mapper;

    /**
     * /
     * @param ProjectDAO $mapper [description]
     */
    public function __construct(ProjectDataMapperContract $mapper)
    {
        $this->mapper = $mapper;
    }
    
    /**
     * Display a listing of the resource.
     * @param  integer $page [description]
     * @return [project]        [description]
     */
    public function index()
    {
        $projects = $this->mapper->fetchAll();
        if (empty($projects->all())) {
            return new Response([], 404, $this->mapper->getMessages());
        }
        return new Response($projects, 200, $this->mapper->getMessages());
    }

    /**
     * /
     * @param  StoreRequest $request [description]
     * @return [project]             [description]
     */
    public function store(StoreRequest $request)
    {
        $input = $request->except(['config', 'user', 'filters']);
        $entity = Project::hydrate($input);
        $unitOfWork = new UnitOfWork($this->mapper, new ObjectStorage);
        try {
            $entity = $this->setStates($entity);
            $unitOfWork->register($entity)->commit();
            return new Response($entity, 200, $this->mapper->getMessages());
        } catch (Exception $e) {
            $unitOfWork->rollback();
            return new Response($entity, 500, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     * @param  int  $pk
     * @return Response
     */
    public function show($pk)
    {
        $project = $this->mapper->fetchById($pk);
        if (!$project) {
            return new Response([], 404, $this->mapper->getMessages());
        }
        $key = 'project_' . $pk;
        $this->saveHashes($project);
        return new Response($project->toArray(), 200, $this->mapper->getMessages());
    }

    protected function saveHashes($entity)
    {
        $projectHash = $entity->getHash();
        $projectHashes = [$entity->id => $projectHash];
        $ticketHashes = $entity->tickets->getHashes();
        $commentHashes = [];
        foreach ($entity->tickets as $ticket) {
            $commentHashes = array_merge($commentHashes, $ticket->comments->getHashes());
        }
        foreach ($projectHashes as $key => $value) {
            $this->saveEntityHash('project' . $key, $value);
        }
        foreach ($ticketHashes as $key => $value) {
            $this->saveEntityHash('ticket_' . $key, $value);
        }
        foreach ($commentHashes as $key => $value) {
            $this->saveEntityHash('comment_' . $key, $value);
        }
    }

    protected function setStates($entity)
    {
        $projectIsNew = !$entity->id;

        if ($projectIsNew) {
            $entity->setState("NEW");
            $tickets = [];
            foreach ($project->tickets as $ticket) {
                $ticket->setState("NEW");

                $comments = [];
                foreach ($ticket->comments as $comment) {
                    $comment->setState("NEW");
                    $comments[] = $comment;
                }
                $ticket->comments = new EntityCollection($comments);
                $tickets[] = $ticket;
            }
            $entity->tickets = new EntityCollection($tickets);
            return $entity;
        }

        $projectHash = $entity->getHash();
        $savedProjectHash = session()->get('project_' . $entity->id);
        $projectIsClean = $entity->id > 0 && $projectHash === $savedProjectHash;
        $projectIsDirty = $entity->id > 0 && $projectHash !== $savedProjectHash;

        if ($projectIsClean) {
            $entity->setState("CLEAN");
        } elseif ($projectIsDirty) {
            $entity->setState("DIRTY");
        }

        if ($projectIsClean || $projectIsDirty) {
            $tickets = [];
            foreach ($entity->tickets as $ticket) {
                $ticketIsNew = !$ticket->id;

                $ticketHash = $ticket->getHash();
                $savedTicketHash = session()->get('ticket_' . $ticket->id);
                $ticketIsClean = $ticket->id > 0 && $ticketHash === $savedTicketHash;
                $ticketIsDirty = $ticket->id > 0 && $ticketHash !== $savedTicketHash;

                if ($ticketIsClean) {
                    $ticket->setState("CLEAN");
                } elseif ($ticketIsDirty) {
                    $ticket->setState("DIRTY");
                }

                $comments = [];
                foreach ($ticket->comments as $comment) {
                    $commentIsNew = !$comment->id;
                    if ($ticketIsNew || $commentIsNew) {
                        $comment->setState("NEW");
                    } else {
                        $commentHash = $comment->getHash();
                        $savedCommentHash = session()->get('comment_' . $comment->id);
                        $commentIsClean = $comment->id > 0 && $commentHash === $savedCommentHash;
                        $commentIsDirty = $comment->id > 0 && $commentHash !== $savedCommentHash;

                        if ($commentIsClean) {
                            $comment->setState("CLEAN");
                        } elseif ($commentIsDirty) {
                            $comment->setState("DIRTY");
                        }
                    }
                    $comments[] = $comment;
                }
                $ticket->comments = $comments;
                $tickets[] = $ticket;
            }
            $entity->tickets = $tickets;
            return $entity;
        }
        throw new \Exception("Error Processing Request", 1);
    }
}
