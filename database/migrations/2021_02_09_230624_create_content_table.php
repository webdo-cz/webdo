<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('content');
        
        Schema::create('content', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('label')->nullable();
            $table->longText('value')->nullable();
            $table->string('page')->nullable();
            $table->string('type')->nullable();
            $table->bigInteger('parent_id')->nullable();
            $table->bigInteger('order')->nullable();
            $table->string('status')->default('production');
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
        Schema::dropIfExists('content');
        $table->dropNestedSet();
    }
}
