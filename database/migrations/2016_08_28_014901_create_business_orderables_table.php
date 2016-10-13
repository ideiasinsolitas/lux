<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessOrderablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_orderables', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->string('orderable_type');
            $table->integer('orderable_id');
            $table->integer('quantity');
            $table->decimal('unit_price', 10, 2);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_orderables');
    }
}
