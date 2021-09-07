<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('label', 255)->nullable();
            $table->longText('value')->nullable();
            $table->string('page', 255)->nullable();
            $table->string('type', 255)->nullable();
            $table->bigInteger('version_id')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('order')->nullable();
            $table->string('status')->default('production');
            $table->timestamps();
            $table->unsignedInteger('_lft');
            $table->unsignedInteger('_rgt');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contents');
    }
}
