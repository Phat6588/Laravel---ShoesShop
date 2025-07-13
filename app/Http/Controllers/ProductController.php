<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\ShoeType;
use Illuminate\Http\Request;

/**
 * Controller cho trang sản phẩm.
 *
 * Đã sửa các lỗi sau:
 * 1. Sửa lại phương thức `index` để:
 * - Lấy sản phẩm với eager loading ('brand', 'shoeType', 'variants') để tối ưu hóa.
 * - Thêm logic lọc sản phẩm theo 'brand' và 'category' (ShoeType) từ query string.
 * - Sử dụng `paginate()` để phân trang.
 * - Lấy và truyền danh sách `$brands` và `$shoeTypes` sang view để hiển thị bộ lọc.
 * 2. Thêm phương thức `show` để xử lý trang chi tiết sản phẩm, hỗ trợ Route Model Binding.
 */
class ProductController extends Controller
{
    /**
     * Hiển thị danh sách sản phẩm có phân trang và bộ lọc.
     */
    public function index(Request $request)
    {
        // Bắt đầu câu truy vấn, eager load các quan hệ cần thiết
        $query = Product::with(['brand', 'shoeType', 'variants']);

        // Lọc theo brandId nếu có trên URL
        if ($request->filled('brand')) {
            $query->where('brandId', $request->brand);
        }

        // Lọc theo typeId (category) nếu có trên URL
        if ($request->filled('category')) {
            $query->where('typeId', $request->category);
        }

        // Lấy kết quả đã phân trang và giữ lại các query string khi chuyển trang
        $products = $query->orderBy('productId', 'desc')->paginate(12)->withQueryString();

        // Lấy tất cả brand và shoe type để hiển thị trong sidebar filter
        $brands = Brand::orderBy('name', 'asc')->get();
        $shoeTypes = ShoeType::orderBy('name', 'asc')->get();

        return view('products', [
            'products' => $products,
            'brands' => $brands,
            'shoeTypes' => $shoeTypes, // Truyền shoeTypes thay vì categories
        ]);
    }

    /**
     * Hiển thị chi tiết một sản phẩm.
     * Laravel sẽ tự động tìm Product có productId khớp với {product} trên URL
     * nhờ có phương thức getRouteKeyName() trong Model Product.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        // Eager load các quan hệ cần thiết cho trang chi tiết
        $product->load(['brand', 'shoeType', 'variants.color', 'variants.size']);

        // Hiện tại chưa có view 'product-detail.blade.php'.
        // Bạn cần tạo file này để hiển thị chi tiết sản phẩm.
        // return view('product-detail', ['product' => $product]);

        // Để kiểm tra nhanh, ta có thể dump dữ liệu ra màn hình.
        // Xóa hoặc thay thế dòng này bằng return view() khi đã có view.
        return dd($product);
    }
}
