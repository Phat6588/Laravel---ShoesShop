<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị trang danh sách sản phẩm với bộ lọc.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Bắt đầu câu truy vấn sản phẩm
        $query = Product::query();

        // Lọc theo màu sắc (có thể chọn nhiều màu)
        if ($request->filled('colors') && is_array($request->colors)) {
            $colors = $request->input('colors');
            $query->whereHas('variants', function ($q) use ($colors) {
                $q->whereIn('color_id', $colors);
            });
        }

        // Lọc theo kích thước (có thể chọn nhiều size)
        if ($request->filled('sizes') && is_array($request->sizes)) {
            $sizes = $request->input('sizes');
            $query->whereHas('variants', function ($q) use ($sizes) {
                $q->whereIn('size_id', $sizes);
            });
        }

        // Sắp xếp theo giá
        if ($request->filled('sort_price')) {
            $sortOrder = $request->input('sort_price') === 'desc' ? 'desc' : 'asc';
            $query->orderBy('price', $sortOrder);
        }

        // Phân trang kết quả (ví dụ: 9 sản phẩm mỗi trang)
        // withQueryString() sẽ tự động thêm các tham số filter vào link phân trang
        $products = $query->paginate(9)->withQueryString();

        // Lấy tất cả màu sắc và kích thước để hiển thị trong form lọc
        $colors = Color::orderBy('name')->get();
        $sizes = Size::orderBy('name')->get();

        return view('products', compact('products', 'colors', 'sizes'));
    }
}
