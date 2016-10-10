<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractDataMapper;
use App\DAL\DefaultDataMapperTrait;

use App\DAL\Business\Sales\Contracts\PaymentDataMapperContract;
use App\DAL\Business\Sales\Contracts\InvoiceDataMapperContract;

class PaymentDataMapper extends AbstractDataMapper
{
    use DefaultDataMapperTrait;
    
    protected $dao;

    protected $invoices;

    public function __construct(PaymentDAOContract $dao, InvoiceDataMapperContract $invoices)
    {
        $this->dao = $dao;
        $this->invoices = $invoices;
    }

    public function createEntity($data)
    {
        $entity = new Payment();
        $entity->invoice = $data->invoice_id;
        $entity->type = $data->type_id;
        $entity->amount = $data->amount;
        $entity->created = $data->created;
    }

    public function fetchRelationships($model)
    {
        return [
            'invoices' => $this->dao->getInvoices($model->id),
        ];
    }

    public function saveRelationships($model)
    {
        foreach ($model->invoices->all() as $invoice) {
            $this->invoices->save($invoice);
        }
    }
}
