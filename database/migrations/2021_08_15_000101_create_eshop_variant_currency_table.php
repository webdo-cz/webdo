<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopVariantCurrencyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_variant_currency', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('variant_id')->unsigned();
            $table->string('name');
            $table->double('price', 15, 2);
            $table->double('price_include_VAT', 15, 2);
            $table->boolean('active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eshop_variant_currency');
    }
}
