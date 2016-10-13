<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_likes', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('likeable_type');
            $table->integer('likeable_id');
            
            $table->unique(['user_id', 'likeable_type', 'likeable_id'], 'core_likes_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_likes');
    }
}
