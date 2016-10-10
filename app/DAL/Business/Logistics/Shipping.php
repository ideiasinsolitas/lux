<?php

namespace App\DAL\Business\Logistics;

use App\DAL\AbstractEntity;
use App\DAL\DefaultEntityTrait;
use App\DAL\Common\Properties;

class Shipping extends AbstractEntity
{
    use DefaultEntityTrait,
        Properties\Identifiable,
        Properties\Typable,
        Properties\Activity,
        Properties\Created;

    protected $cost;

    protected $order;

    protected $storage;

    protected $method;

    protected $tracking_ref;

    protected $shipped;

    protected $delivered;

    public function setCost($value)
    {
        $this->cost = $this->checkValueType($value, 'float');
    }

    public function getCost()
    {
        return $this->cost;
    }

    public function setStorage($value)
    {
        $this->storage = $this->createEntity($value, "\App\DAL\Business\Logistics\Storage");
    }

    public function getStorage()
    {
        return $this->storage;
    }

    public function setOrder($value)
    {
        $this->order = $this->createEntity($valie, "\App\DAL\Business\Sales\Order");
    }

    public function getOrder()
    {
        return $this->order;
    }

    public function setMethod($value)
    {
        $this->method = $this->checkValueType($value, 'string');
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function setTrackingRef($value)
    {
        $this->tracking_ref = $this->checkValueType($value, 'string');
    }

    public function getTrackingRef()
    {
        return $this->tracking_ref;
    }

    public function setShipped($value)
    {
        $this->shipped = $this->checkDateValue($value);
    }

    public function getShipped()
    {
        return $this->shipped;
    }

    public function setDelivered($value)
    {
        $this->delivered = $this->checkDateValue($value);
    }

    public function getDelivered()
    {
        return $this->delivered;
    }
}
