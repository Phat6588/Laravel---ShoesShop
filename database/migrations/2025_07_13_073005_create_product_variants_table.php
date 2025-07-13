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
        // Bảng `ProductVariants` (Biến thể sản phẩm)
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id('variantId');
            $table->decimal('price', 10, 2);
            $table->string('image_url', 2048)->nullable();
            $table->unsignedInteger('stock')->default(0);
            
            $table->unsignedBigInteger('productId');
            $table->unsignedBigInteger('colorId');
            $table->unsignedBigInteger('sizeId');
            
            // $table->timestamps();

            // Unique constraint for a combination of product, color, and size
            $table->unique(['productId', 'colorId', 'sizeId'], 'product_color_size_unique');

            // Foreign key constraints
            $table->foreign('productId')->references('productId')->on('products')->onDelete('cascade');
            $table->foreign('colorId')->references('colorId')->on('colors')->onDelete('cascade');
            $table->foreign('sizeId')->references('sizeId')->on('sizes')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product_variants');
    }
};
