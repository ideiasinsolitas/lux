<?php

namespace App\Models\Business;

class BusinessManager implements DAOManagerContract
{
    protected $namespaces = [];

    public function __construct()
    {
        $this->namespaces = [
            'shipping' => 'App\Models\Business\Logistics\ShippingDAO',
            'storage' => 'App\Models\Business\Logistics\StorageDAO',
            'project' => 'App\Models\Business\ProjectManagement\ProjectDAO',
            'ticket' => 'App\Models\Business\ProjectManagement\TicketDAO',
            'time_tracking' => 'App\Models\Business\ProjectManagement\TimeTrackingDAO',
            'invoice' => 'App\Models\Business\Sales\InvoiceDAO',
            'order' => 'App\Models\Business\Sales\OrderDAO',
            'payment' => 'App\Models\Business\Sales\PaymentDAO',
            'cart' => 'App\Models\Business\Store\CartDAO',
            'customer' => 'App\Models\Business\Store\CustomerDAO',
            'product' => 'App\Models\Business\Store\ProductDAO',
            'shop' => 'App\Models\Business\Store\ShopDAO'
        ];
    }

    public function getDAO($type)
    {
        $namespace = $this->namespaces[$type];
        return DAOFactory::make($namespace);
    }
}
