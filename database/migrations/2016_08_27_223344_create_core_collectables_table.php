<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreCollectablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_collectables', function (Blueprint $table) {
            $table->integer('collection_id');
            $table->string('collectable_type');
            $table->integer('collectable_id');
            $table->integer('order');
            $table->dateTime('created');

            $table->unique(['collection_id', 'collectable_type', 'collectable_id'], 'core_collectable_unique');
            $table->unique(['collection_id', 'order']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_collectables');
    }
}
