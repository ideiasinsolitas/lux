<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    public function insertStorage()
    {
    }

    public function insertOrder()
    {
    }

    public function insertInvoice()
    {
    }

    public function insertPayment()
    {
    }

    public function insertShipping()
    {
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

        for ($i=0; $i < 2; $i++) {
            $this->insertStorage();
        }
    }
}
