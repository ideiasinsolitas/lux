<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('amout', 10, 2);
            $table->tinyInteger('activity');
            $table->dateTime('created');
            $table->dateTime('paid');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_invoices');
    }
}
