<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('type');
            $table->string('title');
            $table->string('teaser')->nullable();
            $table->boolean('custom_teaser')->default(false);
            $table->longText('body')->nullable();
            $table->string('slug');
            $table->string('status')->default('published');
            $table->boolean('reaction_active')->default(false);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('additional_date')->nullable();
            $table->timestamp('published_at')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
