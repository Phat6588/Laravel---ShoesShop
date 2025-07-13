<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    protected $table = 'product_variants';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['productId', 'colorId', 'sizeId', 'price', 'stock', 'image_url'];

    // Một biến thể thuộc về một sản phẩm
    public function product()
    {
        return $this->belongsTo(Product::class, 'productId');
    }

    // Một biến thể có một màu
    public function color()
    {
        return $this->belongsTo(Color::class, 'colorId');
    }

    // Một biến thể có một size
    public function size()
    {
        return $this->belongsTo(Size::class, 'sizeId');
    }
}
