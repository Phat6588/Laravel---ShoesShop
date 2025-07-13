<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * Model cho bảng Users (Quản trị viên).
 *
 * Đã sửa các lỗi sau:
 * 1. Cấu hình lại toàn bộ Model để khớp với bảng 'Users' trong SQL Script thay vì bảng 'users' mặc định của Laravel.
 * 2. Chỉ định bảng 'Users', khóa chính 'userId'.
 * 3. Tắt timestamps.
 * 4. Cập nhật $fillable, $hidden, và $casts để khớp với các cột trong CSDL.
 */
class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'Users';
    protected $primaryKey = 'userId';
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'fullName',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        // 'remember_token', // Cột này không tồn tại trong bảng Users
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // 'email_verified_at' => 'datetime', // Cột này không tồn tại
            'password' => 'hashed',
        ];
    }
}
