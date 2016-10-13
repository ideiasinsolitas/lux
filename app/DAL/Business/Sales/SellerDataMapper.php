<?php

namespace App\DAL\Business\Sales;

use App\DAL\AbstractDataMapper;

class SellerDataMapper extends AbstractDataMapper implements SellerDataMapperContract
{
    public function __construct(
        UserDAOContract $dao,
        ShopDataMapperContract $shops,
        ProductDataMapperContract $products,
        InvoiceDataMapperContract $invoices
    ) {
        $this->dao = $dao;
        $this->shops = $shops;
        $this->products = $products;
        $this->invoices = $invoices;
    }
}
