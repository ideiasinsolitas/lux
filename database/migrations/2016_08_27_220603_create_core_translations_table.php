<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('translatable_type');
            $table->integer('translatable_id');
            $table->string('language');
            $table->string('slug');
            $table->string('name');
            $table->string('description');
            $table->string('title');
            $table->string('subtitle');
            $table->string('tagline');
            $table->string('excerpt');
            $table->string('body');

            $table->unique('slug');
            $table->unique(['language', 'translatable_type', 'translatable_id'], 'core_translatable_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
