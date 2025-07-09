<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    protected $table = 'product_variants';
    protected $fillable = ['product_id', 'color_id', 'size_id', 'price', 'stock_quantity', 'image_url'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
