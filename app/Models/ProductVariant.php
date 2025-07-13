<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductVariant extends Model
{
    use HasFactory;

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
        'stock',
        'image_url',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'productId');
    }
    
    public function color(): BelongsTo
    {
        return $this->belongsTo(Color::class, 'colorId');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'sizeId');
    }
}