<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_name');
            $table->string('slug');
            $table->foreignId('category_id');
            $table->foreignId('subcategory_id')->nullable();
            $table->string('product_price');
            $table->string('product_quantity');
            $table->text('product_summary');
            $table->text('product_description')->nullable();
            $table->text('product_size')->nullable();
            $table->text('product_color')->nullable();
            $table->string('product_thumbnail')->nullable();
            $table->timestamps();
            $table->softDeletes();
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
}
