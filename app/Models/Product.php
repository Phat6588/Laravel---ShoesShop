<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * Tên bảng trong database mà model này đại diện.
     *
     * @var string
     */
    protected $table = 'Products';

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function shoeType()
    {
        return $this->belongsTo(ShoeTypes::class, 'shoe_type_id');
    }

    public function variants()
    {
        return $this->hasMany(ProductVariant::class);
    }
}
