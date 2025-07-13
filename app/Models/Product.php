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
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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
        return $this->belongsTo(ShoeType::class, 'typeId');
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class, 'productId');
    }
}