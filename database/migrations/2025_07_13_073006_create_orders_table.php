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
        // Bảng `Orders` (Đơn hàng)
        Schema::create('orders', function (Blueprint $table) {
            $table->id('orderId');
            $table->string('customerName');
            $table->string('customerEmail');
            $table->string('customerPhone', 20);
            $table->string('shippingAddress', 500);
            $table->decimal('totalPrice', 12, 2);
            $table->string('status', 50)->default('pending'); // e.g., 'pending', 'processing', 'shipped', 'delivered', 'cancelled'
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
        Schema::dropIfExists('orders');
    }
};
