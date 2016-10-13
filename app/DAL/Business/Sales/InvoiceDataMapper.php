<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Core\Sys\Type;
use App\DAL\Business\Sales\Contracts\InvoiceDataMapperContract;
use App\DAL\Business\Sales\Contracts\InvoiceDAOContract;
use App\DAL\Business\Sales\Contracts\OrderDAOContract;

class InvoiceDataMapper extends AbstractDataMapper implements InvoiceDataMapperContract
{
    use DefaultDataMapperTrait;

    protected $dao;
    
    protected $storages;
    
    public function __construct(InvoiceDAOContract $dao)
    {
        $this->dao = $dao;
    }

    public function fetchInputOptions()
    {
        return [
            'type' => $this->dao->getTypes(),
        ];
    }

    public function mapEntity($data)
    {
        $entity = new Invoice();
        $entity->id = $data->id;
        $entity->hours = $data->hours;
        $entity->rate = $data->rate;
        $entity->total = $data->total;
        $entity->activity = $data->activity;
        $entity->created = $data->created;
        $entity->paid = $data->paid;
        return $entity;
    }
}
