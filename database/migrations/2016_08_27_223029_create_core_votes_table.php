<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreVotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_votes', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('votable_type');
            $table->integer('votable_id');
            $table->string('vote');
            $table->dateTime('created');
            
            $table->unique(['user_id', 'votable_type', 'votable_id'], 'core_votes_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_votes');
    }
}
