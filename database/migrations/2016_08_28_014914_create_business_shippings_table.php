<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_shippings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('order_id');
            $table->integer('type_id');
            $table->integer('storage_id');
            $table->integer('delivery_id');
            $table->decimal('cost', 10, 2);
            $table->string('tracking_ref');
            $table->tinyInteger('activity');
            $table->dateTime('created');
            $table->dateTime('shipped')->nullable();
            $table->dateTime('delivered')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_shippings');
    }
}
