<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreCollaborationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_collaborations', function (Blueprint $table) {
            $table->increments('user_id');
            $table->string('collaborative_type');
            $table->integer('collaborative_id');

            $table->unique(['user_id', 'collaborative_type', 'collaborative_id'], 'core_collaborative_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_collaborations');
    }
}
