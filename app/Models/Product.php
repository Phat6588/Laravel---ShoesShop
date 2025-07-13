<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'productId';

    /**
     * Tắt chức năng timestamp tự động của Eloquent.
     * @var bool
     */
    public $timestamps = false; // Thêm dòng này

    protected $fillable = [
        'name',
        'description',
        'brandId',
        'typeId',
    ];

    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class, 'brandId');
    }

    public function shoeType(): BelongsTo
    {
        return $this->belongsTo(ShoeTypes::class, 'typeId');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'productId');
    }
}