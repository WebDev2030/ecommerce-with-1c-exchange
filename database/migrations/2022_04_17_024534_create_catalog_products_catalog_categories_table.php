<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('catalog_products_catalog_categories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('catalog_product_id');
            $table->foreign('catalog_product_id')->references('id')->on('catalog_products');

            $table->unsignedBigInteger('catalog_category_id');
            $table->foreign('catalog_category_id')->references('id')->on('catalog_categories');

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
        Schema::dropIfExists('products');
    }
};
