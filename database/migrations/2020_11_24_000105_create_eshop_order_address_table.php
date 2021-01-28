<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopOrderAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_order_address', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('surname')->nullable();
            $table->string('street')->nullable();
            $table->string('number')->nullable();
            $table->string('city')->nullable();
            $table->string('post_code')->nullable();
            $table->string('state')->nullable();
            $table->bigInteger('order_id')->unsigned();
            $table->string('type');

            $table->foreign('order_id')->references('id')->on('eshop_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eshop_order_address');
    }
}
