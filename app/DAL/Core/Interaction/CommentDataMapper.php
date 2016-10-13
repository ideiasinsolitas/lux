<?php

namespace App\DAL\Core\Interaction;

use App\DAL\AbstractEntity;
use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;
use App\DAL\MessagingTrait;

use App\DAL\Core\Interaction\Contracts\CommentDataMapperContract;

class CommentDataMapper extends AbstractDataMapper implements CommentDataMapperContract
{
    use DefaultDataMapperTrait, MessagingTrait;

    protected $dao;

    public function __construct(CommentDAO $dao)
    {
        $this->dao = $dao;
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
}
