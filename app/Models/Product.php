<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model cho bảng Products.
 *
 * Đã sửa các lỗi sau:
 * 1. Chỉ định rõ tên bảng 'Products' và khóa chính 'productId'.
 * 2. Tắt timestamps.
 * 3. Cập nhật $fillable để sử dụng 'brandId' và 'typeId' thay vì 'brand_id', 'type_id'.
 * 4. Sửa các quan hệ 'brand', 'shoeType', 'variants' để chỉ định rõ khóa ngoại và khóa chính xác, đảm bảo join đúng bảng, đúng cột.
 * 5. Sửa quan hệ 'shoeType' để trỏ đến Model 'ShoeType' đã được sửa.
 */
class Product extends Model
{
    use HasFactory;

    protected $table = 'Products';
    protected $primaryKey = 'productId';
    public $timestamps = false;

<<<<<<< HEAD
=======
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
>>>>>>> parent of 685b8d3 (commit 21:44 09/07/2025)
    protected $fillable = [
        'name',
        'description',
        'brandId',
        'typeId'
    ];

    /**
     * Quan hệ nhiều-một: một sản phẩm thuộc về một thương hiệu.
     */
    public function brand()
    {
        // foreignKey, ownerKey
        return $this->belongsTo(Brand::class, 'brandId', 'brandId');
    }

    /**
     * Quan hệ nhiều-một: một sản phẩm thuộc về một kiểu giày.
     */
    public function shoeType()
    {
<<<<<<< HEAD
        // foreignKey, ownerKey
        return $this->belongsTo(ShoeType::class, 'typeId', 'typeId');
=======
        return $this->belongsTo(ShoeType::class, 'typeId');
>>>>>>> parent of 685b8d3 (commit 21:44 09/07/2025)
    }

    /**
     * Quan hệ một-nhiều: một sản phẩm có nhiều biến thể (màu sắc, kích cỡ).
     */
    public function variants()
    {
        // foreignKey, localKey
        return $this->hasMany(ProductVariant::class, 'productId', 'productId');
    }
}
