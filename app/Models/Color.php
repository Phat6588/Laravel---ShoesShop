<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    protected $primaryKey = 'colorId';
    public $timestamps = false;
    protected $table = 'Colors'; // Đảm bảo tên bảng chính xác

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'color_code', // <-- THÊM DÒNG NÀY
    ];
}