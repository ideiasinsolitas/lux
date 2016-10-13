<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreCollectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_collections', function (Blueprint $table) {
            $table->increments('id');
            $table->string('collector_type');
            $table->integer('collector_id');
            $table->integer('type_id');
            $table->integer('node_id');
            $table->integer('order');
            $table->tinyInteger('activity');
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->dateTime('deleted')->nullable();

            $table->unique(['collector_type', 'collector_id'], 'core_collections_unique');
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
        Schema::drop('core_collections');
    }
}
