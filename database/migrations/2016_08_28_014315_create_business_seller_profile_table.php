<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessSellerProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('business_seller_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('reference_type', ['cpf', 'cnpj']);
            $table->string('reference_number');
            $table->string('company_name')->nullable();
            $table->integer('bank_id');
            $table->string('bank_agency');
            $table->string('bank_account');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('business_seller_profiles');
    }
}
