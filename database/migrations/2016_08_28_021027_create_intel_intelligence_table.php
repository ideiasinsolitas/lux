<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIntelIntelligenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('intel_intelligence', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('project_id');
            $table->integer('intelligence_type');
            $table->integer('intelligence_id');
            $table->tinyInteger('activity');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('intel_intelligence');
    }
}
