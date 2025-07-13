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
        // Bảng `OrderDetails` (Chi tiết đơn hàng)
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('orderDetailId');
            $table->unsignedBigInteger('orderId');
            $table->unsignedBigInteger('variantId');
            $table->unsignedInteger('quantity');
            $table->decimal('price', 10, 2); // Giá tại thời điểm mua
            
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('orderId')->references('orderId')->on('orders')->onDelete('cascade');
            $table->foreign('variantId')->references('variantId')->on('product_variants')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
