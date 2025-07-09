<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoeType;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị trang danh sách sản phẩm.
     */
    public function index()
    {
        // Lấy tất cả sản phẩm cùng với biến thể đầu tiên của chúng để hiển thị
        $products = Product::with('variants')->latest()->paginate(9);

        // Lấy dữ liệu cho bộ lọc
        $shoeTypes = ShoeType::all();
        $colors = Color::all();

        // Trả về view 'products' và truyền dữ liệu vào
        return view('products', [
            'products' => $products,
            'shoeTypes' => $shoeTypes,
            'colors' => $colors,
        ]);
    }
}