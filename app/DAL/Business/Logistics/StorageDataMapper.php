<?php

namespace App\DAL\Business\Logistics;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Business\Logistics\Contracts\StorageDataMapperContract;

class StorageDataMapper extends AbstractDataMapper implements StorageDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;
    protected $places;

    public function __construct(StorageDAOContract $dao, PlaceDataMapper $places)
    {
        $this->dao = $dao;
        $this->place = $places;
    }

    protected function fetchRelationships($entity)
    {
        if (isset($entity->place_id)) {
            $entity->place = $this->dao->getPlace($entity->place_id);
        }
        return $entity;
    }

    protected function createEntity($data)
    {
        $entity = new Storage();
        $entity->id = $data->id;
        $entity->name = $data->name;
        $entity->description = $data->description;
        $entity->place = new Place();
        $entity->place->id = $data->place_id;
        return $entity;
    }
}
