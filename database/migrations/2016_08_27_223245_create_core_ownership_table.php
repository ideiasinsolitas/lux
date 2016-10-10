<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreOwnershipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_ownership', function (Blueprint $table) {
            $table->integer('user_id');
            $table->string('ownable_type');
            $table->integer('ownable_id');
            
            $table->unique(['user_id', 'ownable_type', 'ownable_id'], 'core_ownership_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_ownership');
    }
}
