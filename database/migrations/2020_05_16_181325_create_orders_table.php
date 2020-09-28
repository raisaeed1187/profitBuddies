<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('unique_id');
            $table->Integer('customer_id')->unsigned();
           
            $table->string('exchange_method')->default('Incomplete');
            
            $table->integer('totalAmount')->nullable();
            $table->string('status')->default('pending');
            $table->string('image')->nullable();
            $table->string('imageUploaded')->default('0');
            $table->string('isCompleted')->default('0');
            $table->string('pickUpDate')->nullable();
            $table->string('pickUpTime')->nullable();
            $table->string('outletId')->nullable();            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
