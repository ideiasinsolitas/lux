<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreFolksonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_folksonomy', function (Blueprint $table) {
            $table->integer('term_id');
            $table->integer('user_id');
            $table->string('usertaggable_type');
            $table->integer('usertaggable_id');

            $table->unique(['term_id','user_id','usertaggable_type','usertaggable_id'], 'core_folksonomy_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_folksonomy');
    }
}
