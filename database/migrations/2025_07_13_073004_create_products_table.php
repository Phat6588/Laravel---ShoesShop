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
        // Bảng `Products` (Sản phẩm giày)
        Schema::create('products', function (Blueprint $table) {
            $table->id('productId');
            $table->string('name');
            $table->text('description')->nullable();
            
            $table->unsignedBigInteger('brandId');
            $table->unsignedBigInteger('typeId');
            
            // $table->timestamps();

            // Foreign key constraints
            $table->foreign('brandId')->references('brandId')->on('brands')->onDelete('cascade');
            $table->foreign('typeId')->references('typeId')->on('shoe_types')->onDelete('cascade');
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
