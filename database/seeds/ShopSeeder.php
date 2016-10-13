<?php

use Carbon\Carbon;

class ShopSeeder extends BaseSeeder
{
    protected $parent_node_id;

    protected $current_project_id;
    protected $current_ticket_id;

    public function init()
    {
        $this->faker = $this->getFaker();
        $this->setTypes();
    }

    public function setTypes()
    {
    }

    public function insertSeller()
    {
        $this->insertUser();
        $seller = [
            'user_id' => $this->current_user_id,
            'reference_type' => "cnpj",
            'reference_number' => $this->faker->cnpj,
            'name' => $this->faker->name,
        ];
        $this->current_seller_id = DB::table('business_agents')->insertGetId($seller);
    }

    public function insertShopAndStorage()
    {
        $node = $this->getNodeTemplate('Shop');
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $shop = [
            'node_id' => $node_id,
            'seller_id' => $this->current_seller_id,
            'name' => $this->faker->name,
            'description' => $this->faker->realText(),
            'activity' => 1,
            'created' => Carbon::now()->subDays(rand(1, 200)),
            'modified' => Carbon::now(),
            'deleted' => null
        ];
        $this->current_shop_id = DB::table('business_shops')->insertGetId($shop);
        $this->insertStorage();
    }

    public function insertProduct()
    {
        $node = $this->getNodeTemplate('Product');
        $node_id = DB::table('core_nodes')->insertGetId($node);
        $product = [
            'node_id' => $node_id,
            'shop_id' => $this->current_shop_id,
            'in_stock' => $this->faker->randomNumber,
            'price' => $this->faker->randomNumber(2),
            'weight' => $this->faker->randomNumber(2),
            'height' => $this->faker->randomNumber(2),
            'width' => $this->faker->randomNumber(2),
            'depth' => $this->faker->randomNumber(2),
            'activity' => 1,
            'created' => Carbon::now()->subDays(rand(1, 200)),
            'modified' => Carbon::now(),
            'deleted' => null,
        ];
        $this->current_product_id = DB::table('business_products')->insertGetId($product);
    }

    public function insertCustomer()
    {
        $this->insertUser();
        $customer = [
            'user_id' => $this->current_user_id,
            'reference_type' => "cpf",
            'reference_number' => $this->faker->cpf,
            'name' => $this->faker->name
        ];
        $this->current_customer_id = DB::table('business_agents')->insertGetId($customer);
    }

    public function insertCustomerAndCart()
    {
        $this->insertCustomer();

        $cart = [
            "customer_id" => $this->current_customer_id,
            "product_id" => $this->current_product_id,
            "quantity" => $this->faker->randomNumber(),
        ];
        $this->current_cart_id = DB::table('business_carts')->insertGetId($cart);
    }

    public function insertStorage()
    {
        $this->insertPlace();
        $storage = [
            "place_id" => $this->current_place_id,
            "name" => $this->faker->name,
            "description" => $this->faker->realText()
        ];
        $this->current_storage_id = DB::table('business_storages')->insertGetId($storage);
    }

    public function run()
    {
        $this->init();
        for ($i=1; $i < 5; $i++) {
            $this->insertSeller();

            for ($a=1; $a < rand(2, 4); $a++) {
                $this->insertShopAndStorage();

                for ($x=1; $x < rand(10, 15); $x++) {
                    $this->insertProduct();
                }
            }
        }

        for ($i=1; $i < 5; $i++) {
            $this->insertCustomerAndCart();
        }
    }
}
