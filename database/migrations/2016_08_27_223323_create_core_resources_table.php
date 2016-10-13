<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreResourcesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_resources', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->integer('node_id');
            $table->string('name');
            $table->string('description');
            $table->string('url');
            $table->string('embed');
            $table->tinyInteger('activity');
            $table->dateTime('created');
            $table->dateTime('deleted')->nullable();

            $table->unique(['node_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_resources');
    }
}
