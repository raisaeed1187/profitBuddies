<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExchangesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchanges', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id')->unsigned();
            $table->string('fromCountry')->nullable();
            $table->string('toCountry')->nullable();
            $table->string('fromCountryCode')->nullable();
            $table->string('toCountryCode')->nullable();

            $table->string('fromAmount')->nullable();
            $table->string('toAmount')->nullable();
            $table->string('buying_selling')->nullable();
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
        Schema::dropIfExists('exchanges');
    }
}
