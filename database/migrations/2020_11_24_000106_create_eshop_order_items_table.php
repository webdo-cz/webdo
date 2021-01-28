<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_order_items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('order_id')->unsigned();
            $table->string('product_id');
            $table->bigInteger('variant_id')->unsigned()->nullable();
            $table->bigInteger('quantity');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('eshop_orders');
            $table->foreign('product_id')->references('id')->on('posts');
            $table->foreign('variant_id')->references('id')->on('eshop_product_variants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eshop_order_items');
    }
}
