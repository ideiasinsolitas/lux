<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

class OrderDataMapper extends AbstractDataMapper
{
    use DefaultDataMapperTrait;

    protected $dao;
    
    protected $payments;

    protected $shippings;

    public function __construct(
        OrderDAOContract $dao,
        PaymentDataMapperContract $payments,
        ShippingDataMapperContract $shippings
    ) {
        $this->dao = $dao;
        $this->payments = $payments;
        $this->shippings = $shippings;
    }

    protected function saveRelationships($entity)
    {
        foreach ($entity->payments->all() as $payment) {
            $this->payments->save($payment);
        }
        $this->shippings->save($entity->shipping);
    }

    public function mapEntity($model)
    {
        return $model->toArray();
    }

    public function createEntity($data)
    {
        $entity = new Order();
        $entity->id = $data->id;
        $entity->payment_method = $data->payment_method;
        $entity->shipping = new Shipping();
        $entity->shipping->method = $data->shipping_method;
        $entity->shipping->cost = $data->shipping_cost;
        $entity->price = $data->price;
        $entity->taxes = $data->taxes;
        $entity->extra_cost = $data->extra_cost;
        $entity->total = $data->total;
        $entity->created = $data->created;
        $entity->closed = $data->closed;

        return $entity;
    }

    public function fetchRelationships($model)
    {
        return [
            'payments' => $this->dao->getPayments($model->id),
            'shipping' => $this->dao->getShipping($model->id)
        ];
    }

    public function fetchInputOptions()
    {
        return [
        ];
    }
}
