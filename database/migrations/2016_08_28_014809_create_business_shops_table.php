<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_shops', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id');
            $table->integer('seller_id');
            $table->string('name');
            $table->string('description');
            $table->tinyInteger('activity');
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->dateTime('deleted')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_shops');
    }
}
