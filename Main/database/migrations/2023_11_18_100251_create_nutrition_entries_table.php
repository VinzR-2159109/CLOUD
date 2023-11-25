<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('nutrition_entries', function (Blueprint $table) {
            $table->id();
            $table->string('food_name');
            $table->integer('calories');
            $table->integer('protein');
            $table->integer('carbohydrates');
            $table->integer('fat');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_entries');
    }
};
