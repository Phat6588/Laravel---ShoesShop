<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Model cho bảng Orders.
 *
 * Đã sửa các lỗi sau:
 * 1. Chỉ định rõ tên bảng 'Orders' và khóa chính 'orderId'.
 * 2. Cấu hình timestamps để khớp với các cột 'orderDate' (thay cho created_at) và 'updated_at' trong SQL Script.
 * 3. Thêm các quan hệ 'orderDetails' và 'invoice'.
 */
class Order extends Model
{
    use HasFactory;

    protected $table = 'Orders';
    protected $primaryKey = 'orderId';

    /**
     * Định nghĩa tên cột cho 'created_at'.
     */
    const CREATED_AT = 'orderDate';

    /**
     * Định nghĩa tên cột cho 'updated_at'.
     */
    const UPDATED_AT = 'updated_at';


    protected $fillable = [
        'customerName',
        'customerEmail',
        'customerPhone',
        'shippingAddress',
        'totalAmount',
        'status'
    ];

    /**
     * Quan hệ một-nhiều: một đơn hàng có nhiều chi tiết đơn hàng.
     */
    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'orderId', 'orderId');
    }

    /**
     * Quan hệ một-một: một đơn hàng có một hóa đơn.
     */
    public function invoice()
    {
        return $this->hasOne(Invoice::class, 'orderId', 'orderId');
    }
}
