<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntelEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intel_events', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('calendar_id');
            $table->integer('place_id');
            $table->integer('type_id');
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('activity');
            $table->dateTime('start');
            $table->dateTime('end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('intel_events');
    }
}
