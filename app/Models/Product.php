<?php
// File: app/Models/Product.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'productId';

    // Một sản phẩm thuộc về một thương hiệu
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    // Một sản phẩm thuộc về một loại giày
    public function shoeType()
    {
        return $this->belongsTo(ShoeType::class, 'typeId');
    }

    // Một sản phẩm có nhiều biến thể
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'productId');
    }
}