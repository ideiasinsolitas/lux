<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_files', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('type_id');
            $table->integer('node_id');
            $table->string('name');
            $table->string('description');
            $table->string('filepath');
            $table->string('filename');
            $table->string('mimetype');
            $table->string('extension');
            $table->integer('width');
            $table->integer('height');
            $table->dateTime('created');
            $table->dateTime('modified');
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
        Schema::drop('core_files');
    }
}
