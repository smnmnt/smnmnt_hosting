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
        Schema::create('collection_linkers', function (Blueprint $table) {
            $table->bigIncrements('coll_link_id');
            $table->bigInteger('coll_id')->unsigned();
            $table->bigInteger('prod_id')->unsigned();
            $table->timestamps();

            $table->foreign('coll_id')->references('coll_id')->on('collections');
            $table->foreign('prod_id')->references('prod_id')->on('products');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('collection_linkers');
    }
};
