<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentVersionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('content_versions', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->nullable();
            $table->string('slug', 255)->nullable();
            $table->string('post_id', 255)->nullable();
            $table->string('type', 255)->nullable();
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
        Schema::dropIfExists('content_versions');
    }
}
