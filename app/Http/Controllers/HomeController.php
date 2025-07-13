<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * Controller cho trang chủ.
 *
 * Đã sửa các lỗi sau:
 * 1. `Product::latest()` sẽ gây lỗi vì bảng 'Products' không có cột 'created_at'.
 * Đã thay thế bằng `orderBy('productId', 'desc')` để lấy các sản phẩm mới nhất.
 * 2. `where('featured', true)` sẽ gây lỗi vì bảng 'Products' không có cột 'featured'.
 * Đã thay thế bằng `inRandomOrder()` để lấy sản phẩm ngẫu nhiên làm "sản phẩm nổi bật" (chỉ để demo).
 * Để có chức năng thực sự, bạn nên thêm cột 'featured' (boolean) vào bảng 'Products'.
 * 3. Thêm eager loading (`with`) để tối ưu hóa truy vấn, tránh vấn đề N+1 query.
 */
class HomeController extends Controller
{
    public function index()
    {
        // Lấy 8 sản phẩm mới nhất
        $newProducts = Product::with(['brand', 'variants'])
                              ->orderBy('productId', 'desc')
                              ->take(8)
                              ->get();

        // Lấy 8 sản phẩm ngẫu nhiên làm sản phẩm nổi bật
        $featuredProducts = Product::with(['brand', 'variants'])
                                   ->inRandomOrder()
                                   ->take(8)
                                   ->get();

        return view('home', compact('newProducts', 'featuredProducts'));
    }
}
