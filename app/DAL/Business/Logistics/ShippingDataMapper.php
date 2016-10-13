<?php

namespace App\DAL\Business\Logistics;

use App\DAL\Core\Sys\Type;
use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;
use App\DAL\Business\Logistics\Contracts\ShippingDataMapperContract;
use App\DAL\Business\Logistics\Contracts\ShippingDAOContract;
use App\DAL\Business\Logistics\Contracts\OrderDAOContract;

class ShippingDataMapper extends AbstractDataMapper implements ShippingDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;
    
    protected $storages;
    
    public function __construct(ShippingDAOContract $dao, StorageDataMapperContract $storages)
    {
        $this->dao = $dao;
        $this->storages = $storages;
    }

    public function fetchInputOptions()
    {
        return [
            'types' => $this->dao->getTypes(),
            'storages' => $this->dao->getStorages(),
        ];
    }

    protected function saveRelationships($model)
    {
        $this->storages->save($model->storage);
    }

    public function createEntity($data)
    {
        $entity = new Shipping();
        $entity->id = $data->id;
        $entity->type = new Type();
        $entity->type->id = $data->type_id;
        $entity->type->name = $data->type;
        $entity->cost = $data->cost;
        $entity->tracking_ref = $data->tracking_ref;
        $entity->activity = $data->activity;
        $entity->created = $data->created;
        $entity->shipped = $data->shipped;
        $entity->delivered = $data->delivered;

        return $entity;
    }
}
