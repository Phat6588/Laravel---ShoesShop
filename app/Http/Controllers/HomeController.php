<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ với sản phẩm bán chạy và sản phẩm mới.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // --- Lấy sản phẩm bán chạy ---
        // Đã cập nhật để sử dụng bảng 'OrderDetails'
        $bestSellingProductIds = DB::table('OrderDetails')
            ->join('ProductVariants', 'OrderDetails.product_variant_id', '=', 'ProductVariants.id')
            ->join('Products', 'ProductVariants.product_id', '=', 'Products.id')
            ->select('Products.id', DB::raw('SUM(OrderDetails.quantity) as total_quantity'))
            ->groupBy('Products.id')
            ->orderByDesc('total_quantity')
            ->take(15)
            ->pluck('id')
            ->toArray();

        // Khởi tạo Paginator rỗng để tránh lỗi nếu không có sản phẩm
        $bestSellers = new LengthAwarePaginator([], 0, 5, 1, [
            'path' => request()->url(),
            'pageName' => 'bestsellers_page',
        ]);

        // Nếu có sản phẩm bán chạy, lấy và phân trang 5 sản phẩm/trang
        if (!empty($bestSellingProductIds)) {
            $bestSellers = Product::whereIn('id', $bestSellingProductIds)
                ->orderByRaw(DB::raw("FIELD(id, " . implode(',', $bestSellingProductIds) . ")"))
                ->paginate(5, ['*'], 'bestsellers_page');
        }

        // --- Lấy sản phẩm mới ---
        $newestProductIds = Product::latest()->take(15)->pluck('id')->toArray();
        
        $newProducts = Product::whereIn('id', $newestProductIds)
            ->latest()
            ->paginate(5, ['*'], 'new_products_page');

        return view('home', compact('bestSellers', 'newProducts'));
    }
}
