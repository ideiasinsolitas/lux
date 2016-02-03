<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GeoLocationTableSeeder extends Seeder
{

    public function run()
    {

        if (env('DB_DRIVER')=='mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        }

        $this->call(AddressTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(DistrictTableSeeder::class);
        $this->call(PlaceTableSeeder::class);
        $this->call(ProvinceTableSeeder::class);

        if (env('DB_DRIVER')=='mysql') {
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
}
