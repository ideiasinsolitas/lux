<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);

        $this->call(ProjectSeeder::class);
        $this->call(ShopSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
