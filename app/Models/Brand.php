<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model cho bảng Brands.
 *
 * Đã sửa các lỗi sau:
 * 1. Chỉ định rõ tên bảng 'Brands' và khóa chính 'brandId' để khớp với SQL Script.
 * 2. Tắt tính năng timestamps (created_at, updated_at) vì không được định nghĩa trong SQL Script.
 * 3. Thêm quan hệ 'products' để lấy tất cả sản phẩm thuộc về thương hiệu này.
 * 4. Thêm hàm getRouteKeyName() để hỗ trợ Route Model Binding bằng 'brandId'.
 */
class Brand extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong cơ sở dữ liệu.
     * @var string
     */
    protected $table = 'Brands';

    /**
     * Khóa chính của bảng.
     * @var string
     */
    protected $primaryKey = 'brandId';

    /**
     * Tắt tính năng tự động quản lý timestamps của Eloquent.
     * @var bool
     */
    public $timestamps = false;

    /**
     * Các thuộc tính có thể được gán hàng loạt.
     * @var array
     */
    protected $fillable = [
        'name',
        'image_url'
    ];

    /**
     * Định nghĩa quan hệ một-nhiều: một thương hiệu có nhiều sản phẩm.
     */
    public function products()
    {
        // foreignKey, ownerKey
        return $this->hasMany(Product::class, 'brandId', 'brandId');
    }

    /**
     * Lấy tên khóa cho route model binding.
     * Giúp Laravel tự động tìm Brand từ URL bằng brandId.
     * Ví dụ: /brands/{brand} -> tự động tìm Brand có brandId = {brand}
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'brandId';
    }
}
