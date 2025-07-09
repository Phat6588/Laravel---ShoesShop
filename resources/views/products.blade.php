@extends('layouts.app')

@section('title', 'Tất cả sản phẩm - Biti\'s')

@section('content')
<style>
    .filter-group { margin-bottom: 25px; }
    .filter-group h4 { margin-top: 0; margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 5px; }
    .filter-group ul { list-style: none; padding: 0; }
    .filter-group ul li { margin-bottom: 5px; }
    .filter-group ul li a { text-decoration: none; color: #555; }
    .filter-group ul li a:hover { color: #d9534f; }
    .color-options span { display: inline-block; width: 20px; height: 20px; border-radius: 50%; margin-right: 5px; cursor: pointer; border: 1px solid #ccc; }
    .product-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
    .product-card { background-color: #fff; border: 1px solid #e0e0e0; border-radius: 8px; overflow: hidden; text-align: center; padding-bottom: 15px; }
    .product-card img { width: 100%; height: 220px; object-fit: cover; }
    .product-card-info { padding: 15px; }
    .product-card-info h3 { font-size: 1rem; margin: 0 0 10px; height: 40px; }
    .product-card-info .price { font-weight: bold; color: #d9534f; }
    .pagination { margin-top: 40px; display: flex; justify-content: center; }
</style>

<div style="display: flex;">
    {{-- CỘT BỘ LỌC BÊN TRÁI --}}
    <aside style="width: 25%; padding-right: 25px;">
        <h3>BỘ LỌC</h3>

        {{-- Lọc theo Kiểu giày (dữ liệu từ controller) --}}
        <div class="filter-group">
            <h4>Kiểu Giày</h4>
            <ul>
                @foreach($shoeTypes as $type)
                    <li><a href="#">{{ $type->name }}</a></li>
                @endforeach
            </ul>
        </div>

        {{-- Lọc theo Màu sắc (dữ liệu từ controller) --}}
        <div class="filter-group">
            <h4>Màu Sắc</h4>
            <div class="color-options">
                 @foreach($colors as $color)
                    <span style="background-color: {{ strtolower($color->name) }};" title="{{ $color->name }}"></span>
                @endforeach
            </div>
        </div>
        
        <div class="filter-group">
            <h4>Mức Giá</h4>
            <ul>
                <li><a href="#">Dưới 500.000đ</a></li>
                <li><a href="#">500.000đ - 1.000.000đ</a></li>
                <li><a href="#">Trên 1.000.000đ</a></li>
            </ul>
        </div>
    </aside>

    {{-- LƯỚI SẢN PHẨM BÊN PHẢI --}}
    <div style="width: 75%;">
        <div class="product-grid">
            
            {{-- Lặp qua biến $products được truyền từ Controller --}}
            @foreach($products as $product)
            <div class="product-card">
                {{-- Lấy ảnh từ biến thể đầu tiên, nếu không có thì dùng ảnh placeholder --}}
                <img src="{{ $product->variants->first()->image_url ?? 'https://via.placeholder.com/220x220.png?text=Biti\'s' }}" alt="{{ $product->name }}">
                <div class="product-card-info">
                    <h3>{{ $product->name }}</h3>
                    {{-- Lấy giá từ biến thể đầu tiên, nếu không có thì hiển thị 'Liên hệ' --}}
                    <p class="price">{{ $product->variants->first() ? number_format($product->variants->first()->price, 0, ',', '.') . ' đ' : 'Liên hệ' }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Hiển thị phân trang --}}
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection