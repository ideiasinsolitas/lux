<?php

use Illuminate\Database\Seeder;

use Carbon\Carbon;

class BaseSeeder extends Seeder
{
    public function getFaker()
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

        return $faker;
    }

    public function getNodeTemplate($class)
    {
        return [
            'parent_id' => $this->parent_node_id > 0 ? $this->parent_node_id : 0,
            'created' => Carbon::now()->subDays(rand(1, 200)),
            'modified' => Carbon::now(),
            'activity' => 1,
            'class' => $class
        ];
    }

    public function insertUser()
    {
        $user = [
            "username" => $this->faker->username,
            "email" => $this->faker->email,
            "password" => bcrypt("secret"),
            "first_name" => $this->faker->firstName,
            "middle_name" => $this->faker->lastName,
            "last_name" => $this->faker->lastName,
            "activity" => 1,
            "created" => Carbon::now()->subDays(rand(20, 30)),
            "modified" => Carbon::now()->subDays(rand(10, 20)),
            "deleted" => null
        ];
        $this->current_user_id = DB::table('core_users')->insertGetId($user);
        return $this->current_user_id;
    }

    public function setPlaceType($name)
    {
        $this->current_place_type_id = $this->insertType($name, "Place");
        return $this->current_place_type_id;
    }

    public function insertType($name, $class)
    {
        $type = [
            "name" => $name,
            "class" => $class,
        ];
        return DB::table('core_types')->insertGetId($type);
    }

    public function insertPlace()
    {
        $coordinate = [
            "lat" => $this->faker->latitude,
            "lon" => $this->faker->longitude
        ];

        $coordinate_id = DB::table('intel_coordinates')->insertGetId($coordinate);

        $address = [
            'street' => $this->faker->streetName,
            'number' => $this->faker->buildingNumber,
            'zipcode' => $this->faker->postcode,
            'coordinate_id' => $coordinate_id,
            'city_id' => 19, // Rio de Janeiro - RJ
        ];
        $address_id = DB::table('intel_addresses')->insertGetId($address);
        $place = [
            'address_id' => $address_id,
            'type_id' => $this->current_place_type_id,
        ];
        $this->current_place_id = DB::table('intel_places')->insertGetId($place);
        return $this->current_place_id;
    }

    public function getCollectionTemplate()
    {
        return [];
    }

    public function getResourceTemplate()
    {
        return [];
    }
}
