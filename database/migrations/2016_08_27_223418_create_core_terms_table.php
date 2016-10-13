<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTermsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_terms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id');
            $table->integer('parent_id');
            $table->integer('type_id');
            $table->tinyInteger('activity');

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
        Schema::drop('core_terms');
    }
}
