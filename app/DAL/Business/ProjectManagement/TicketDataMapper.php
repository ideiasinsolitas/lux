<?php

namespace App\DAL\Business\ProjectManagement;

use App\DAL\AbstractEntity;
use App\DAL\AbstractDataMapper;
use App\DAL\ObjectStorage;
use App\DAL\UnitOfWork;
use App\DAL\MutableTrait;
use App\DAL\MessagingTrait;
use App\DAL\Exceptions\MappingException;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Business\ProjectManagement\Contracts\TicketDAOContract;
use App\DAL\Core\Interaction\Contracts\CommentDataMapperContract;
use App\DAL\Business\ProjectManagement\Contracts\TicketDataMapperContract;
use App\DAL\Business\ProjectManagement\Contracts\TimeTrackingDataMapperContract;

class TicketDataMapper extends AbstractDataMapper implements TicketDataMapperContract
{
    use DefaultDataMapperTrait, MessagingTrait, MutableTrait;

    protected $dao;
    protected $trackings;
    protected $comments;

    public function __construct(
        TicketDAOContract $dao,
        CommentDataMapperContract $comments,
        TimeTrackingDataMapperContract $trackings
    ) {
        $this->dao = $dao;
        $this->comments = $comments;
        $this->trackings = $trackings;
    }

    public function mapEntity(AbstractEntity $model)
    {
        $record = $model->toArray();
        $record['responsible_id'] = $record['responsible']['id'];
        unset($record['responsible']);
        $record['customer_id'] = $record['customer']['id'];
        unset($record['customer']);
        $record['project_id'] = $record['project']['id'];
        unset($record['project']);
        return $record;
    }

    public function createEntity($data)
    {
        $class = self::ENTITY_CLASS;
        return $class::hydrate($data);
    }

    public function fetchByProjectId($project_id)
    {
        $this->filters['project_id'] = $project_id;
        $list = $this->dao->getAll($this->filters);
        $collection = $this->createEntityCollection($list);
        $collection = $collection->map(function ($item) {
            return $this->addRelationshipsToEntity($item);
        });
        return $collection;
    }
    
    protected function fetchRelationships($entity)
    {
        $comments = $this->dao->getComments($entity->id);
        return [
            'comments' => $comments
        ];
    }

    protected function saveRelationships($model)
    {
        if ($model->comments) {
            foreach ($model->comments->all() as $comment) {
                if ($this->getState() === "REMOVED") {
                    $this->comments->remove($comment);
                } else {
                    $this->comments->save($comment);
                }
            }
        }

        if ($model->trackings) {
            foreach ($model->trackings->all() as $tracking) {
                if ($this->getState() === "REMOVED") {
                    $this->trackings->remove($tracking);
                } else {
                    $this->trackings->save($tracking);
                }
            }
        }
    }
}
