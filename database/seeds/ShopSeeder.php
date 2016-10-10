<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class ShopSeeder extends Seeder
{
    protected $current_project_id;
    protected $current_ticket_id;
    
    protected $parent_node_id;

    public function init()
    {
        $faker = new \Faker\Generator();
        $faker->addProvider(new \Faker\Provider\pt_BR\Person($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Address($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\Company($faker));
        $faker->addProvider(new \Faker\Provider\en_US\Text($faker));
        $faker->addProvider(new \Faker\Provider\pt_BR\PhoneNumber($faker));
        $faker->addProvider(new \Faker\Provider\DateTime($faker));
        $faker->addProvider(new \Faker\Provider\Internet($faker));
        $faker->addProvider(new \Faker\Provider\Lorem($faker));

        $this->faker = $faker;
    }

    public function insertSeller()
    {
        $seller = [
            'reference_type' => ,
            'reference_number' => ,
            'company_name' => ,
            'bank_id' => ,
            'bank_agency' => ,
            'bank_account'
        ];
        DB::table('business_seller_profiles')->insert($seller);
    }

    public function insertShop()
    {
        $shop = [
            'node_id' => ,
            'seller_id' => ,
            'name' => ,
            'description' => ,
            'activity' => ,
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
            'deleted' => ,
        ];
        DB::table('business_shops')->insert($shop);
    }

    public function insertProduct()
    {
        $product = [
            'node_id' => ,
            'shop_id' => ,
            'in_stock' => ,
            'price' => ,
            'weight' => ,
            'height' => ,
            'width' => ,
            'depth' => ,
            'activity' => ,
            'created' => Carbon::now(),
            'modified' => Carbon::now(),
            'deleted' => ,
        ];
        DB::table('business_products')->insert($product);
    }

    public function insertCustomer()
    {
        $customer = [];
        DB::table('business_customers')->insert($customer);
    }

    public function insertCart()
    {
        $this->insertCustomer();

        $cart = [];
        DB::table('business_carts')->insert($cart);
    }

    public function run()
    {
        $this->init();
        for ($i=1; $i < 5; $i++) {
            $this->insertSeller();

            for ($a=1; $a < rand(20, 40); $a++) {
                $this->insertShop();

                for ($x=1; $x < rand(10, 30); $x++) {
                    $this->insertProduct();
                }
            }
        }

        for ($i=1; $i < 5; $i++) {
            $this->insertCart();
        }
    }
}
