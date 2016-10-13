<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntelAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intel_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street');
            $table->string('number');
            $table->string('zipcode')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('city_id');
            $table->integer('coordinate_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('intel_addresses');
    }
}
