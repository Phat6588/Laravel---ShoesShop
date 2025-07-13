<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Brand;
use App\Models\ShoeType;
use App\Models\Color;
use App\Models\Size;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use App\Models\Wishlist;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Vô hiệu hóa kiểm tra khóa ngoại để tránh lỗi khi truncate
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Xóa dữ liệu cũ trong các bảng
        // Wishlist::truncate();
        OrderDetail::truncate();
        Order::truncate();
        ProductVariant::truncate();
        Product::truncate();
        Size::truncate();
        Color::truncate();
        ShoeType::truncate();
        Brand::truncate();
        User::truncate();

        // Bật lại kiểm tra khóa ngoại
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // --- Bảng `brands` ---
        $brands = [
            ['name' => 'Nike', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Nike'],
            ['name' => 'Adidas', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Adidas'],
            ['name' => 'Puma', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Puma'],
            ['name' => 'Converse', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Converse'],
            ['name' => 'Vans', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Vans'],
            ['name' => 'Biti\'s', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Biti\'s'],
            ['name' => 'New Balance', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=New+Balance'],
            ['name' => 'ASICS', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=ASICS'],
            ['name' => 'Dr. Martens', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Dr.+Martens'],
            ['name' => 'Ananas', 'image_url' => 'https://placehold.co/150x80/EFEFEF/333333?text=Ananas'],
        ];
        Brand::insert($brands);

        // --- Bảng `shoe_types` ---
        $shoeTypes = [
            ['name' => 'Sneaker'],
            ['name' => 'Giày chạy bộ (Running)'],
            ['name' => 'Giày bóng rổ (Basketball)'],
            ['name' => 'Bốt (Boots)'],
            ['name' => 'Giày Tây (Dress Shoes)'],
            ['name' => 'Sandal'],
            ['name' => 'Giày lười (Slip-on)'],
            ['name' => 'Giày trượt ván (Skate)'],
        ];
        ShoeType::insert($shoeTypes);

        // --- Bảng `colors` ---
        $colors = [
            ['name' => 'Đen', 'hex_color' => '#000000'],
            ['name' => 'Trắng', 'hex_color' => '#FFFFFF'],
            ['name' => 'Xám', 'hex_color' => '#808080'],
            ['name' => 'Xanh Dương', 'hex_color' => '#0000FF'],
            ['name' => 'Đỏ', 'hex_color' => '#FF0000'],
            ['name' => 'Beige', 'hex_color' => '#F5F5DC'],
            ['name' => 'Xanh Lá', 'hex_color' => '#008000'],
            ['name' => 'Nâu', 'hex_color' => '#A52A2A'],
            ['name' => 'Vàng', 'hex_color' => '#FFFF00'],
            ['name' => 'Cam', 'hex_color' => '#FFA500'],
        ];
        Color::insert($colors);

        // --- Bảng `sizes` ---
        $sizes = [
            ['name' => '38'], ['name' => '39'], ['name' => '40'], ['name' => '41'],
            ['name' => '42'], ['name' => '43'], ['name' => '44'], ['name' => '45'],
        ];
        Size::insert($sizes);

        // --- Bảng `products` ---
        $products = [
            ['name' => 'Nike Air Force 1 \'07', 'description' => 'Mẫu sneaker kinh điển, biểu tượng của Nike.', 'brandId' => 1, 'typeId' => 1],
            ['name' => 'Adidas Ultraboost Light', 'description' => 'Giày chạy bộ siêu nhẹ với đệm Boost hoàn trả năng lượng.', 'brandId' => 2, 'typeId' => 2],
            ['name' => 'Converse Chuck 70 Classic', 'description' => 'Phiên bản cao cấp của dòng Chuck Taylor All Star.', 'brandId' => 4, 'typeId' => 1],
            ['name' => 'Vans Old Skool', 'description' => 'Giày trượt ván với sọc jazz đặc trưng.', 'brandId' => 5, 'typeId' => 8],
            ['name' => 'Biti\'s Hunter X', 'description' => 'Dòng sneaker hiện đại được yêu thích của Biti\'s.', 'brandId' => 6, 'typeId' => 1],
            ['name' => 'Dr. Martens 1460', 'description' => 'Mẫu bốt 8 lỗ huyền thoại, bền bỉ và cá tính.', 'brandId' => 9, 'typeId' => 4],
            ['name' => 'New Balance 550', 'description' => 'Thiết kế bóng rổ retro đang thịnh hành trở lại.', 'brandId' => 7, 'typeId' => 3],
            ['name' => 'ASICS Gel-Kayano 30', 'description' => 'Giày chạy bộ ổn định hàng đầu cho người cần hỗ trợ.', 'brandId' => 8, 'typeId' => 2],
            ['name' => 'Puma Suede Classic', 'description' => 'Mẫu giày da lộn không bao giờ lỗi mốt.', 'brandId' => 3, 'typeId' => 1],
            ['name' => 'Ananas Urbas', 'description' => 'Dòng sneaker vải canvas từ thương hiệu Việt Nam.', 'brandId' => 10, 'typeId' => 1],
            ['name' => 'Nike Dunk Low', 'description' => 'Sneaker bóng rổ retro với nhiều phối màu đa dạng.', 'brandId' => 1, 'typeId' => 3],
            ['name' => 'Adidas Samba OG', 'description' => 'Mẫu giày classic của Adidas, phù hợp nhiều phong cách.', 'brandId' => 2, 'typeId' => 1],
            ['name' => 'Vans Slip-On Checkerboard', 'description' => 'Giày lười kinh điển với họa tiết caro.', 'brandId' => 5, 'typeId' => 7],
            ['name' => 'New Balance 990v6', 'description' => 'Dòng giày chạy bộ cao cấp, biểu tượng của New Balance.', 'brandId' => 7, 'typeId' => 2],
            ['name' => 'Nike Air Jordan 1 Mid', 'description' => 'Phiên bản cổ lửng của dòng giày bóng rổ huyền thoại.', 'brandId' => 1, 'typeId' => 3],
            ['name' => 'Converse One Star', 'description' => 'Một mẫu giày classic khác của Converse.', 'brandId' => 4, 'typeId' => 1],
            ['name' => 'Biti\'s Hunter Street', 'description' => 'Phiên bản Hunter cho phong cách đường phố.', 'brandId' => 6, 'typeId' => 1],
            ['name' => 'Puma RS-X', 'description' => 'Thiết kế sneaker hầm hố, hiện đại.', 'brandId' => 3, 'typeId' => 1],
            ['name' => 'ASICS Novablast 4', 'description' => 'Giày chạy bộ đa dụng, êm ái và nảy.', 'brandId' => 8, 'typeId' => 2],
            ['name' => 'Dr. Martens Jadon', 'description' => 'Phiên bản đế độn cá tính của dòng 1460.', 'brandId' => 9, 'typeId' => 4],
        ];
        Product::insert($products);

        // --- Bảng `product_variants` ---
        $variants = [
            ['productId' => 1, 'colorId' => 2, 'sizeId' => 4, 'price' => 2990000.00, 'stock' => 120, 'image_url' => 'https://placehold.co/600x600/FFFFFF/333333?text=AF1+White'],
            ['productId' => 1, 'colorId' => 1, 'sizeId' => 4, 'price' => 2990000.00, 'stock' => 95, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=AF1+Black'],
            ['productId' => 2, 'colorId' => 1, 'sizeId' => 3, 'price' => 4800000.00, 'stock' => 50, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Ultraboost'],
            ['productId' => 3, 'colorId' => 1, 'sizeId' => 3, 'price' => 1800000.00, 'stock' => 200, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Chuck+70'],
            ['productId' => 4, 'colorId' => 1, 'sizeId' => 3, 'price' => 1700000.00, 'stock' => 180, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Old+Skool'],
            ['productId' => 5, 'colorId' => 7, 'sizeId' => 4, 'price' => 950000.00, 'stock' => 110, 'image_url' => 'https://placehold.co/600x600/008000/FFFFFF?text=Hunter+X'],
            ['productId' => 6, 'colorId' => 1, 'sizeId' => 5, 'price' => 4500000.00, 'stock' => 40, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Dr+Martens'],
            ['productId' => 7, 'colorId' => 2, 'sizeId' => 3, 'price' => 3200000.00, 'stock' => 60, 'image_url' => 'https://placehold.co/600x600/FFFFFF/333333?text=NB+550'],
            ['productId' => 8, 'colorId' => 4, 'sizeId' => 5, 'price' => 4200000.00, 'stock' => 25, 'image_url' => 'https://placehold.co/600x600/0000FF/FFFFFF?text=Kayano+30'],
            ['productId' => 9, 'colorId' => 1, 'sizeId' => 4, 'price' => 1500000.00, 'stock' => 75, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Puma+Suede'],
            ['productId' => 10, 'colorId' => 6, 'sizeId' => 2, 'price' => 490000.00, 'stock' => 130, 'image_url' => 'https://placehold.co/600x600/F5F5DC/333333?text=Ananas+Urbas'],
            ['productId' => 11, 'colorId' => 2, 'sizeId' => 4, 'price' => 3200000.00, 'stock' => 80, 'image_url' => 'https://placehold.co/600x600/FFFFFF/333333?text=Dunk+Low'],
            ['productId' => 12, 'colorId' => 1, 'sizeId' => 3, 'price' => 2500000.00, 'stock' => 90, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Samba+OG'],
            ['productId' => 13, 'colorId' => 1, 'sizeId' => 5, 'price' => 1600000.00, 'stock' => 100, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Slip-On'],
            ['productId' => 14, 'colorId' => 3, 'sizeId' => 4, 'price' => 5500000.00, 'stock' => 20, 'image_url' => 'https://placehold.co/600x600/808080/FFFFFF?text=NB+990v6'],
            ['productId' => 15, 'colorId' => 5, 'sizeId' => 5, 'price' => 3800000.00, 'stock' => 60, 'image_url' => 'https://placehold.co/600x600/FF0000/FFFFFF?text=Jordan+1+Mid'],
            ['productId' => 16, 'colorId' => 2, 'sizeId' => 3, 'price' => 1750000.00, 'stock' => 70, 'image_url' => 'https://placehold.co/600x600/FFFFFF/333333?text=One+Star'],
            ['productId' => 17, 'colorId' => 1, 'sizeId' => 4, 'price' => 890000.00, 'stock' => 150, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Hunter+Street'],
            ['productId' => 18, 'colorId' => 3, 'sizeId' => 5, 'price' => 2800000.00, 'stock' => 45, 'image_url' => 'https://placehold.co/600x600/808080/FFFFFF?text=Puma+RS-X'],
            ['productId' => 19, 'colorId' => 4, 'sizeId' => 4, 'price' => 4100000.00, 'stock' => 35, 'image_url' => 'https://placehold.co/600x600/0000FF/FFFFFF?text=Novablast+4'],
            ['productId' => 20, 'colorId' => 1, 'sizeId' => 5, 'price' => 5200000.00, 'stock' => 30, 'image_url' => 'https://placehold.co/600x600/000000/FFFFFF?text=Jadon'],
        ];
        ProductVariant::insert($variants);

        // --- Bảng `orders` và `order_details` ---
        $orders = [
            ['customerName' => 'Trần Văn An', 'customerEmail' => 'an.tran@guest.com', 'customerPhone' => '0901234567', 'shippingAddress' => '123 Đường ABC, Phường 1, Quận 1, TP.HCM', 'totalPrice' => 2990000.00, 'status' => 'delivered', 'details' => [['variantId' => 1, 'quantity' => 1, 'price' => 2990000.00]]],
            ['customerName' => 'Lê Thị Bình', 'customerEmail' => 'binh.le@guest.com', 'customerPhone' => '0902345678', 'shippingAddress' => '456 Đường XYZ, Phường 2, Quận 3, TP.HCM', 'totalPrice' => 4800000.00, 'status' => 'shipped', 'details' => [['variantId' => 3, 'quantity' => 1, 'price' => 4800000.00]]],
            ['customerName' => 'Phạm Văn Cường', 'customerEmail' => 'cuong.pham@guest.com', 'customerPhone' => '0903456789', 'shippingAddress' => '789 Đường DEF, Phường 3, Quận 5, TP.HCM', 'totalPrice' => 1800000.00, 'status' => 'processing', 'details' => [['variantId' => 4, 'quantity' => 1, 'price' => 1800000.00]]],
            ['customerName' => 'Nguyễn Thị Dung', 'customerEmail' => 'dung.nguyen@guest.com', 'customerPhone' => '0904567890', 'shippingAddress' => '101 Đường GHI, Phường 4, Quận 10, TP.HCM', 'totalPrice' => 1700000.00, 'status' => 'pending', 'details' => [['variantId' => 5, 'quantity' => 1, 'price' => 1700000.00]]],
            ['customerName' => 'Vũ Văn Em', 'customerEmail' => 'em.vu@guest.com', 'customerPhone' => '0905678901', 'shippingAddress' => '112 Đường KLM, Phường 5, Quận Bình Thạnh, TP.HCM', 'totalPrice' => 950000.00, 'status' => 'delivered', 'details' => [['variantId' => 6, 'quantity' => 1, 'price' => 950000.00]]],
            ['customerName' => 'Hoàng Thị Giang', 'customerEmail' => 'giang.hoang@guest.com', 'customerPhone' => '0906789012', 'shippingAddress' => '113 Đường NOP, Phường 6, Quận Phú Nhuận, TP.HCM', 'totalPrice' => 4500000.00, 'status' => 'cancelled', 'details' => [['variantId' => 7, 'quantity' => 1, 'price' => 4500000.00]]],
            ['customerName' => 'Đặng Văn Hải', 'customerEmail' => 'hai.dang@guest.com', 'customerPhone' => '0907890123', 'shippingAddress' => '114 Đường QRS, Phường 7, Quận 7, TP.HCM', 'totalPrice' => 3200000.00, 'status' => 'delivered', 'details' => [['variantId' => 8, 'quantity' => 1, 'price' => 3200000.00]]],
            ['customerName' => 'Bùi Thị Hương', 'customerEmail' => 'huong.bui@guest.com', 'customerPhone' => '0908901234', 'shippingAddress' => '115 Đường TUV, Phường 8, TP. Thủ Đức', 'totalPrice' => 4200000.00, 'status' => 'shipped', 'details' => [['variantId' => 9, 'quantity' => 1, 'price' => 4200000.00]]],
            ['customerName' => 'Ngô Văn Kiên', 'customerEmail' => 'kien.ngo@guest.com', 'customerPhone' => '0909012345', 'shippingAddress' => '116 Đường WXY, Phường 9, Quận Gò Vấp, TP.HCM', 'totalPrice' => 1500000.00, 'status' => 'delivered', 'details' => [['variantId' => 10, 'quantity' => 1, 'price' => 1500000.00]]],
            ['customerName' => 'Mai Thị Lan', 'customerEmail' => 'lan.mai@guest.com', 'customerPhone' => '0912123456', 'shippingAddress' => '117 Đường Z, Phường 10, Quận Tân Bình, TP.HCM', 'totalPrice' => 490000.00, 'status' => 'processing', 'details' => [['variantId' => 11, 'quantity' => 1, 'price' => 490000.00]]],
            ['customerName' => 'Lý Văn Mạnh', 'customerEmail' => 'manh.ly@guest.com', 'customerPhone' => '0913234567', 'shippingAddress' => '212 Đường A, Quận 1, TP.HCM', 'totalPrice' => 5700000.00, 'status' => 'delivered', 'details' => [['variantId' => 1, 'quantity' => 1, 'price' => 2990000.00], ['variantId' => 12, 'quantity' => 1, 'price' => 2710000.00]]],
        ];

        // Lặp qua mảng dữ liệu và tạo bản ghi
        foreach ($orders as $orderData) {
            $details = $orderData['details'];
            unset($orderData['details']);

            // Tạo đơn hàng
            $order = Order::create($orderData);

            // Tạo chi tiết đơn hàng
            foreach ($details as $detail) {
                $detail['orderId'] = $order->orderId; // Lấy ID của đơn hàng vừa tạo
                OrderDetail::create($detail);
            }
        }
        
        // --- Bảng `users` ---
        $users = [
            ['name' => 'Admin User', 'email' => 'admin@example.com', 'password' => Hash::make('password')],
            ['name' => 'Test User', 'email' => 'user@example.com', 'password' => Hash::make('password')],
        ];
        User::insert($users);

        // --- Bảng `wishlists` ---
        // $wishlists = [
        //     ['user_id' => 1, 'product_id' => 1],
        //     ['user_id' => 1, 'product_id' => 5],
        //     ['user_id' => 2, 'product_id' => 1],
        //     ['user_id' => 2, 'product_id' => 10],
        //     ['user_id' => 2, 'product_id' => 15],
        // ];
        // Wishlist::insert($wishlists);
    }
}
