<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_tickets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('node_id');
            $table->integer('responsible_id');
            $table->integer('customer_id');
            $table->integer('project_id');
            $table->string('problem_url');
            $table->string('description');
            $table->tinyInteger('activity');
            $table->dateTime('created');
            $table->dateTime('modified');
            $table->dateTime('deleted');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_tickets');
    }
}
