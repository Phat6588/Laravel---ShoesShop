<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model cho bảng ProductVariants.
 *
 * Đã sửa các lỗi sau:
 * 1. Chỉ định rõ tên bảng 'ProductVariants' và khóa chính 'variantId'.
 * 2. Tắt timestamps.
 * 3. Cập nhật $fillable để sử dụng 'productId', 'colorId', 'sizeId'.
 * 4. Sửa các quan hệ 'product', 'color', 'size' để chỉ định rõ khóa ngoại và khóa chính xác.
 * 5. Thêm quan hệ 'orderDetails' để liên kết đến chi tiết đơn hàng.
 */
class ProductVariant extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $table = 'ProductVariants';
=======
>>>>>>> parent of 685b8d3 (commit 21:44 09/07/2025)
    protected $primaryKey = 'variantId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'productId',
        'colorId',
        'sizeId',
        'price',
        'stock'
    ];

    /**
     * Quan hệ nhiều-một: một biến thể thuộc về một sản phẩm.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId', 'productId');
    }

    /**
     * Quan hệ nhiều-một: một biến thể có một màu sắc.
     */
    public function color()
    {
        return $this->belongsTo(Color::class, 'colorId', 'colorId');
    }

    /**
     * Quan hệ nhiều-một: một biến thể có một kích cỡ.
     */
    public function size()
    {
        return $this->belongsTo(Size::class, 'sizeId', 'sizeId');
    }

    /**
     * Quan hệ một-nhiều: một biến thể có thể xuất hiện trong nhiều chi tiết đơn hàng.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'variantId', 'variantId');
    }
}
