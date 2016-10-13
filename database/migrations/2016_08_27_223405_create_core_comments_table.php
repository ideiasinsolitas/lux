<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id');
            $table->integer('node_id');
            $table->integer('user_id');
            $table->string('commentable_type');
            $table->integer('commentable_id');
            $table->text('comment');
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
        Schema::drop('core_comments');
    }
}
