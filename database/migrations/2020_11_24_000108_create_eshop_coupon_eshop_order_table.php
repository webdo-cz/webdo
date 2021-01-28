<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopCouponEshopOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_coupon_eshop_order', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('eshop_coupon_id')->unsigned();
            $table->bigInteger('eshop_order_id')->unsigned();

            $table->foreign('eshop_coupon_id')->references('id')->on('eshop_coupons');
            $table->foreign('eshop_order_id')->references('id')->on('eshop_orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eshop_coupon_eshop_order');
    }
}
