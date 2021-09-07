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
            $table->string('type', 255)->nullable();
            $table->string('title', 255)->nullable();
            $table->string('teaser', 255)->nullable();
            $table->longText('body')->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('page_title', 255)->nullable();
            $table->string('seo_title', 255)->nullable();
            $table->string('seo_description', 255)->nullable();
            $table->string('seo_keywords', 255)->nullable();
            $table->string('status', 255)->nullable();
            $table->boolean('reaction_active')->default(false);
            $table->boolean('custom_teaser')->default(false);
            $table->bigInteger('user_id')->unsigned();
            $table->timestamp('additional_date')->nullable();
            $table->timestamp('published_at')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
