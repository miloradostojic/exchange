<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInitialTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('short_name')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->double('surcharge_percent')->nullable();
            $table->double('discount_percent')->nullable();
            $table->timestamps();
        });
        
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->nullable();
            $table->timestamps();
        });
        
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('currency_id')->unsigned();
            $table->double('currency_amount')->nullable();
            $table->double('exchange_rate')->nullable();
            $table->double('surcharge_percent')->nullable();
            $table->double('surcharge_amount')->nullable();
            $table->double('paid_amount_usd')->nullable();
            $table->double('discount_percent')->nullable();
            $table->double('discount_amount')->nullable();
            $table->timestamps();
            
            $table->foreign('currency_id')
                ->references('id')
                ->on('currencies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('currencies');
        Schema::dropIfExists('settings');
        Schema::dropIfExists('orders');
    }
}
