<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm với bộ lọc.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        // Bắt đầu với câu truy vấn cơ bản cho model Product
        $query = Product::query()->with('brand');

        // Lọc theo thương hiệu (có thể chọn nhiều)
        if ($request->filled('brands')) {
            $query->whereIn('brand_id', $request->brands);
        }

        // Lọc theo màu sắc (có thể chọn nhiều)
        // Sử dụng whereHas để kiểm tra sự tồn tại của biến thể có màu sắc được chọn
        if ($request->filled('colors')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('color_id', $request->colors);
            });
        }

        // Lọc theo kích cỡ (có thể chọn nhiều)
        // Sử dụng whereHas để kiểm tra sự tồn tại của biến thể có kích cỡ được chọn
        if ($request->filled('sizes')) {
            $query->whereHas('variants', function ($q) use ($request) {
                $q->whereIn('size_id', $request->sizes);
            });
        }

        // Sắp xếp theo giá
        if ($request->filled('sort_by')) {
            if ($request->sort_by == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($request->sort_by == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        } else {
            // Sắp xếp mặc định nếu không có lựa chọn
            $query->orderBy('created_at', 'desc');
        }

        // Lấy danh sách sản phẩm đã lọc và phân trang
        $products = $query->paginate(12);

        // Lấy tất cả các tùy chọn cho bộ lọc
        $brands = Brand::orderBy('name', 'asc')->get();
        $colors = Color::orderBy('name', 'asc')->get();
        $sizes = Size::orderBy('name', 'asc')->get();

        // Trả về view cùng với các dữ liệu cần thiết
        return view('products.index', [
            'products' => $products,
            'brands' => $brands,
            'colors' => $colors,
            'sizes' => $sizes,
            'selectedBrands' => $request->brands ?? [],
            'selectedColors' => $request->colors ?? [],
            'selectedSizes' => $request->sizes ?? [],
            'selectedSort' => $request->sort_by ?? '',
        ]);
    }
}
