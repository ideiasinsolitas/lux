<?php

use Carbon\Carbon;

class OrderSeeder extends BaseSeeder
{
    protected $parent_node_id;
    protected $current_node_id;

    protected $current_place_id;
    protected $current_storage_id;
    protected $current_order_id;
    protected $current_type_id;
    protected $current_payment_type_id;
    protected $current_shipping_type_id;
    protected $current_invoice_id;

    public function init()
    {
        $this->faker = $this->getFaker();
    }

    public function insertOrder()
    {
        $this->insertPlace();
        $order = [
            "customer_id" => $this->current_customer_id,
            "delivery_place_id" => $this->current_place_id,
            "seller_id" => $this->current_seller_id,
            "invoice_id" => $this->current_invoice_id,
            "payment_type_id" => $this->current_payment_type_id,
            "shipping_type_id" => $this->current_shipping_type_id,
            "price" => $this->faker->randomNumber(2),
            "taxes" => $this->faker->randomNumber(2),
            "extra_cost" => $this->faker->randomNumber(2),
            "closed" => Carbon::now(),
        ];
        $this->current_order_id = DB::table('business_orders')->insertGetId($order);
    }

    public function insertInvoice()
    {
        $invoice = [
            'amount' => $this->faker->randomNumber,
            'activity' => 1,
            'created' => $this->faker->dateTimeThisMonth,
            'paid' => Carbon::now(),
        ];
        $this->current_invoice_id = DB::table('business_invoices')->insertGetId($invoice);
    }

    public function insertPayment()
    {
        $payment = [
            "invoice_id" => $this->current_invoice_id,
            "type_id" => $this->current_type_id,
            "amount" => $this->faker->randomNumber(2),
            "created" => Carbon::now()
        ];
        $this->current_payment_id = DB::table('business_payments')->insertGetId($payment);
    }

    public function insertShipping()
    {
        $shipping = [
            "order_id" => $this->current_order_id,
            "type_id" => $this->current_type_id,
            "cost" => $this->faker->randomNumber(2),
            "tracking_ref" => $this->faker->sha1(uuid()),
            "activity" => 1,
            "created" =>  Carbon::now()->subDays(rand(20, 60)),
            "shipped" =>  Carbon::now()->subDays(rand(10, 20)),
            "delivered" => Carbon::now()->subDays(rand(1, 10))
        ];
        $this->current_shipping_id = DB::table('business_shippings')->insertGetId($shipping);
    }

    public function run()
    {
        $this->init();
        for ($i=1; $i < 5; $i++) {
            $this->insertOrder();
            $this->insertShipping();
            $this->insertInvoice();

            for ($a=1; $a < rand(2, 12); $a++) {
                $this->insertPayment();
            }
        }
    }
}
