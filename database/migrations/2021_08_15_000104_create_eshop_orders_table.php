<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->string('email')->nullable();
            $table->string('telephone')->nullable();
            $table->longText('note')->nullable();
            $table->bigInteger('shipment_id')->unsigned()->nullable();
            $table->integer('shipment_code')->nullable();
            $table->bigInteger('payment_id')->unsigned()->nullable();
            $table->integer('payment_code')->nullable();
            $table->string('total');
            $table->string('status');
            $table->boolean('cart')->default(true);
            $table->boolean('canceled')->default(false);
            $table->timestamp('submited_at')->nullable();
            $table->timestamps();

            $table->foreign('shipment_id')->references('id')->on('eshop_shipments');
            $table->foreign('payment_id')->references('id')->on('eshop_payments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eshop_orders');
    }
}
