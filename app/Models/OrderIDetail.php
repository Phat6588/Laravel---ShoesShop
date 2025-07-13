<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong database mà model này đại diện.
     *
     * @var string
     */
    protected $table = 'OrderDetails';

    /**
     * Các thuộc tính có thể được gán hàng loạt.
     *
     * @var array
     */
    protected $fillable = [
        'order_id',
        'product_variant_id',
        'quantity',
        'price',
    ];

    /**
     * Lấy đơn hàng mà chi tiết này thuộc về.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Lấy biến thể sản phẩm cho chi tiết đơn hàng này.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
