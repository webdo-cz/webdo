<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTermTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_term', function (Blueprint $table) {
            $table->id();
            $table->string('post_id');
            $table->bigInteger('term_id')->unsigned();

            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('term_id')->references('id')->on('terms');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_term');
    }
}
