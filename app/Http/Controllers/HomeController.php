<?php

namespace App\Http\Controllers;

use App\Models\OrderDetail;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Hiển thị trang chủ với các sản phẩm mới nhất và bán chạy nhất.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // --- LƯU Ý QUAN TRỌNG VỀ MODEL ---
        // Đảm bảo các Model của bạn đã được cấu hình để sử dụng đúng tên bảng và khóa chính
        // đã được định nghĩa trong migrations.
        //
        // Ví dụ, trong Model `ProductVariant`:
        // protected $table = 'product_variants';
        // protected $primaryKey = 'variantId';
        //
        // Tương tự cho các Model khác: `Product`, `Brand`, `OrderDetail`...

        // --- Lấy Sản Phẩm Mới Nhất ---
        // Sắp xếp theo khóa chính 'variantId' giảm dần để lấy các biến thể được thêm vào gần đây nhất.
        $newestProducts = ProductVariant::with('product.brand')
            ->orderBy('variantId', 'desc')
            ->take(15)
            ->get()
            // Nhóm theo `productId` để không hiển thị trùng lặp sản phẩm trên slider.
            ->unique('productId');

        // --- Lấy Sản Phẩm Bán Chạy Nhất ---
        // Cột khóa ngoại trong bảng `order_details` trỏ tới `product_variants` là 'variantId'.
        $foreignKeyInOrderDetails = 'variantId';

        // 1. Lấy danh sách ID của các biến thể bán chạy nhất.
        $bestSellingVariantIds = OrderDetail::select($foreignKeyInOrderDetails, DB::raw('SUM(quantity) as total_quantity'))
            ->groupBy($foreignKeyInOrderDetails)
            ->orderBy('total_quantity', 'desc')
            ->take(15)
            ->pluck($foreignKeyInOrderDetails);

        $bestSellingProducts = new Collection();

        if ($bestSellingVariantIds->isNotEmpty()) {
            // 2. Lấy thông tin chi tiết của các biến thể bán chạy nhất.
            // Sử dụng `orderByRaw` với `FIELD` để giữ đúng thứ tự bán chạy.
            
            // SỬA LỖI: Bỏ DB::raw() không cần thiết bên trong orderByRaw()
            $idOrder = $bestSellingVariantIds->implode(',');
            $bestSellingProducts = ProductVariant::with('product.brand')
                ->whereIn('variantId', $bestSellingVariantIds)
                ->orderByRaw("FIELD(variantId, " . $idOrder . ")")
                ->get()
                ->unique('productId');
        }

        // --- Xử lý Fallback ---
        // Nếu không có sản phẩm bán chạy (do chưa có đơn hàng nào), lấy sản phẩm ngẫu nhiên.
        if ($bestSellingProducts->isEmpty() && OrderDetail::count() == 0) {
            $bestSellingProducts = ProductVariant::with('product.brand')
                ->inRandomOrder()
                ->take(15)
                ->get()
                ->unique('productId');
        }

        return view('home', [
            'newestProducts' => $newestProducts,
            'bestSellingProducts' => $bestSellingProducts,
        ]);
    }
}
