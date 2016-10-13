<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id');
            $table->integer('delivery_place_id');
            $table->integer('seller_id');
            $table->integer('invoice_id');
            $table->integer('payment_type_id');
            $table->integer('shipping_type_id');
            $table->decimal('price', 10, 2);
            $table->decimal('taxes', 10, 2);
            $table->decimal('extra_cost', 10, 2);
            $table->dateTime('closed')->nullable();
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
