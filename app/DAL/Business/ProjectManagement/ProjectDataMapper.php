<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractEntity;
use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;
use App\DAL\MessagingTrait;
use App\DAL\MutableTrait;
use App\DAL\ObjectStorage;
use App\DAL\UnitOfWork;
use App\DAL\EntityCollection;
use App\DAL\Exceptions\MappingException;

use App\DAL\Business\ProjectManagement\Contracts\ProjectDAOContract;
use App\DAL\Business\ProjectManagement\Contracts\ProjectDataMapperContract;
use App\DAL\Business\ProjectManagement\Contracts\TicketDataMapperContract;

class ProjectDataMapper extends AbstractDataMapper implements ProjectDataMapperContract
{
    use DefaultDataMapperTrait, MessagingTrait, MutableTrait;

    protected $dao;
    protected $tickets;

    public function __construct(
        ProjectDAOContract $dao,
        TicketDataMapperContract $tickets
    ) {
        $this->dao = $dao;
        $this->tickets = $tickets;
    }

    public function mapEntity(AbstractEntity $model)
    {
        $record = $model->toArray();
        $record['node_id'] = $record['node']['id'];
        unset($record['node']);
        return $record;
    }

    public function createEntity($data)
    {
        $class = self::ENTITY_CLASS;
        return $class::hydrate($data);
    }
    
    protected function fetchRelationships($entity)
    {
        return [
            'tickets' => $this->tickets->fetchByProjectId($entity->id)
        ];
    }

    protected function saveRelationships($model)
    {
        foreach ($model->tickets->all() as $ticket) {
            if ($this->getState() === "REMOVED") {
                $this->tickets->remove($ticket);
            } else {
                $this->tickets->save($ticket);
            }
        }
    }

    protected function deleteRelationships($entity)
    {
        foreach ($model->tickets->all() as $ticket) {
            $this->tickets->remove($ticket);
        }
    }
}
