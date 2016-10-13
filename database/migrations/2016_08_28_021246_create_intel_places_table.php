<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntelPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intel_places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->integer('address_id');
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->string('address_line')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('intel_places');
    }
}
