<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('prod_id');
            $table->string('prod_name')->unique();
            $table->string('prod_img');
            $table->bigInteger('prod_genre')->unsigned();
            $table->bigInteger('prod_band')->unsigned();
            $table->longText('prod_desc');
            $table->integer('prod_year');
            $table->integer('prod_price');
            $table->integer('prod_sale')->nullable();
            $table->timestamps();

            $table->foreign('prod_genre')->references('genre_id')->on('genres');
            $table->foreign('prod_band')->references('band_id')->on('bands');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
