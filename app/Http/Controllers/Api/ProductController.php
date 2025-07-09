<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ShoeTypes;
use App\Models\Color;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Bắt đầu câu truy vấn với Model Product
        $query = Product::query();

        // Lọc theo Kiểu Giày (type)
        if ($request->filled('type')) {
            $query->whereHas('shoeType', function ($q) use ($request) {
                $q->where('name', $request->query('type'));
            });
        }

        // Lọc theo Màu Sắc (color)
        if ($request->filled('color')) {
            // Sử dụng whereHas để lọc các sản phẩm có ít nhất một biến thể (variant)
            // khớp với màu sắc được chọn.
            $query->whereHas('variants.color', function ($q) use ($request) {
                $q->where('name', $request->query('color'));
            });
        }
        
        // Lọc theo khoảng giá (price_range)
        if ($request->filled('price_range')) {
            $range = explode('-', $request->query('price_range'));
            $minPrice = $range[0];
            $maxPrice = $range[1] ?? null;

            $query->whereHas('variants', function ($q) use ($minPrice, $maxPrice) {
                $q->where('price', '>=', $minPrice);
                if ($maxPrice) {
                    $q->where('price', '<=', $maxPrice);
                }
            });
        }

        // Lấy danh sách sản phẩm đã lọc, kèm theo các biến thể của chúng.
        // withQueryString() sẽ giữ lại các tham số lọc khi chuyển trang.
        $products = $query->with('variants')->orderBy('productId', 'desc')->paginate(9)->withQueryString();

        // Lấy dữ liệu cho sidebar bộ lọc
        $shoeTypes = ShoeTypes::all();
        $colors = Color::all();

        // Trả về view cùng với dữ liệu sản phẩm và các bộ lọc
        return view('products', [
            'products' => $products,
            'shoeTypes' => $shoeTypes,
            'colors' => $colors,
        ]);
    }
}