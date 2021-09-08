<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('prefix');
            $table->bigInteger('number')->unsigned();
            $table->bigInteger('order_id')->unsigned();
            $table->timestamp('created_at')->useCurrent();

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
        Schema::dropIfExists('eshop_invoices');
    }
}
