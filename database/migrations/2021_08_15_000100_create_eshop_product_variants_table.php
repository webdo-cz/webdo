<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEshopProductVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('eshop_product_variants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->double('price', 15, 2);
            $table->double('price_without_VAT', 15, 2)->nullable();
            $table->double('buy_price', 15, 2)->nullable();
            $table->string('VAT')->nullable();
            $table->string('weight')->nullable();
            $table->string('availability')->nullable();
            $table->string('availability_empty')->nullable();
            $table->boolean('active')->default(true);
            $table->string('product_id');
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
        Schema::dropIfExists('eshop_product_variants');
    }
}
