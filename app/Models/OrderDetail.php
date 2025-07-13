<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model cho bảng OrderDetails.
 *
 * QUAN TRỌNG: Hãy đổi tên file từ OrderIDetail.php thành OrderDetail.php.
 *
 * Đã sửa các lỗi sau:
 * 1. Đổi tên class từ 'OrderIDetail' thành 'OrderDetail'.
 * 2. Chỉ định rõ tên bảng 'OrderDetails' và khóa chính 'orderDetailId'.
 * 3. Tắt timestamps.
 * 4. Cập nhật $fillable để sử dụng 'orderId' và 'variantId'.
 * 5. Thêm các quan hệ 'order' và 'productVariant'.
 */
class OrderDetail extends Model
{
    use HasFactory;

    protected $table = 'OrderDetails';
    protected $primaryKey = 'orderDetailId';
    public $timestamps = false;

    protected $fillable = [
        'orderId',
        'variantId',
        'quantity',
        'price'
    ];

    /**
     * Quan hệ nhiều-một: chi tiết đơn hàng thuộc về một đơn hàng.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'orderId', 'orderId');
    }

    /**
     * Quan hệ nhiều-một: chi tiết đơn hàng tương ứng với một biến thể sản phẩm.
     */
    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class, 'variantId', 'variantId');
    }
}
