<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTaxonomyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('core_taxonomy', function (Blueprint $table) {
            $table->integer('term_id');
            $table->string('ownertaggable_type');
            $table->integer('ownertaggable_id');

            $table->unique(['term_id', 'ownertaggable_type', 'ownertaggable_id'], 'core_taxonomy_unique');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('core_taxonomy');
    }
}
