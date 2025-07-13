<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model cho bảng ShoeTypes.
 *
 * QUAN TRỌNG: Hãy đổi tên file từ ShoeTypes.php thành ShoeType.php.
 *
 * Đã sửa các lỗi sau:
 * 1. Đổi tên class từ 'ShoeTypes' thành 'ShoeType' theo quy ước của Laravel (tên model là số ít).
 * 2. Chỉ định rõ tên bảng 'ShoeTypes' và khóa chính 'typeId'.
 * 3. Tắt timestamps.
 * 4. Thêm quan hệ 'products' để lấy tất cả sản phẩm thuộc kiểu giày này.
 */
class ShoeType extends Model // Tên class đã được đổi thành số ít
{
    use HasFactory;

    protected $table = 'ShoeTypes';
    protected $primaryKey = 'typeId';
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    /**
     * Định nghĩa quan hệ một-nhiều: một kiểu giày có nhiều sản phẩm.
     */
    public function products()
    {
        // foreignKey, ownerKey
        return $this->hasMany(Product::class, 'typeId', 'typeId');
    }
}
