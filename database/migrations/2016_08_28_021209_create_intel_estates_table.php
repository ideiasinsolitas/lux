<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntelEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intel_estates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id');
            $table->integer('type_id');
            $table->integer('area');
            $table->integer('rooms');
            $table->integer('suites');
            $table->integer('parking_spots');
            $table->double('price');
            $table->double('charges');
            $table->double('taxes');
            $table->string('description');
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->dateTime('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('intel_estates');
    }
}
