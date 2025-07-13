<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;
    protected $primaryKey = 'orderDetailId';
    protected $fillable = ['orderId', 'variantId', 'quantity', 'price'];

    // Chi tiết đơn hàng thuộc về một đơn hàng
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId');
    }

    // Chi tiết đơn hàng ứng với một biến thể sản phẩm
    public function variant()
    {
        return $this->belongsTo(ProductVariant::class, 'variantId');
    }
}
