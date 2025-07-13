<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{
    use HasFactory;
    protected $primaryKey = 'orderId';
    protected $fillable = ['userId', 'customerName', 'customerEmail', 'customerPhone', 'shippingAddress', 'totalPrice', 'status'];

    // Một đơn hàng có nhiều chi tiết đơn hàng
    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'orderId');
    }

    // Một đơn hàng thuộc về một người dùng (nếu có)
    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }
}
