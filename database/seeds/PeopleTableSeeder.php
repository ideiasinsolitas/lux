<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PeopleTableSeeder extends Seeder {

    public function run() {

        if(env('DB_DRIVER')=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        $this->call(ContactTableSeeder::class);
        $this->call(InstitutionTableSeeder::class);
        $this->call(PersonTableSeeder::class);

        if(env('DB_DRIVER')=='mysql')
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}