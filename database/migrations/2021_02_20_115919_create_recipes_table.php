<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
          $table->id();
          $table->string('slug')->nullable();
          $table->string('original_name')->nullable();
          $table->string('image')->nullable();
          $table->unsignedTinyInteger('preparation_time');
          $table->unsignedTinyInteger('price_range');
          $table->boolean('is_public');
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
        Schema::dropIfExists('recipes');
    }
}
