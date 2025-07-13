@extends('layouts.app')

@section('title', 'Tất cả sản phẩm - Biti\'s')

@section('content')
<style>
    /* Bố cục chính */
    .product-page-container {
        display: flex;
        flex-wrap: wrap; /* Cho phép xuống hàng trên màn hình nhỏ */
        gap: 30px; /* Khoảng cách giữa sidebar và content */
    }

    /* Cột bộ lọc (Sidebar) */
    .product-sidebar {
        width: 100%; /* Chiếm toàn bộ chiều rộng trên màn hình nhỏ */
        max-width: 250px; /* Giới hạn chiều rộng tối đa */
        flex-shrink: 0; /* Không co lại khi không đủ không gian */
    }

    /* Khu vực nội dung chính (Lưới sản phẩm) */
    .product-main-content {
        flex-grow: 1; /* Tự động lấp đầy không gian còn lại */
    }

    /* Tùy chỉnh cho bộ lọc */
    .filter-group { 
        margin-bottom: 25px; 
    }
    .filter-group h4 { 
        margin-top: 0; 
        margin-bottom: 15px; 
        border-bottom: 1px solid #eee; 
        padding-bottom: 10px; 
        font-size: 1.1em;
    }
    .filter-group ul { list-style: none; padding: 0; }
    .filter-group ul li { margin-bottom: 8px; }
    .filter-group ul li a { text-decoration: none; color: #333; }
    .filter-group ul li a:hover { color: #d9534f; }
    .filter-group ul li a.active { font-weight: bold; color: #d9534f; }

    /* Tùy chỉnh cho các chấm màu */
    .color-options {
        display: flex;
        flex-wrap: wrap;
    }
    .color-options a {
        margin: 0 8px 8px 0;
    }
    .color-options span {
        display: inline-block;
        width: 24px;
        height: 24px;
        border-radius: 50%;
        cursor: pointer;
        border: 2px solid #fff;
        box-shadow: 0 0 0 1px #ccc;
        transition: all 0.2s;
    }
    .color-options span.active {
        box-shadow: 0 0 0 2px #d9534f;
    }

    /* Lưới sản phẩm */
    .product-grid { 
        display: grid; 
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); 
        gap: 20px; 
    }
    .product-card { 
        background-color: #fff; 
        border: 1px solid #e0e0e0; 
        border-radius: 8px; 
        overflow: hidden; 
        text-align: center; 
    }
    .product-card img { 
        width: 100%; 
        height: 220px; 
        object-fit: cover; 
    }
    .product-card-info { padding: 15px; }
    .product-card-info h3 { 
        font-size: 1rem; 
        margin: 0 0 10px; 
        height: 40px; /* Giữ chiều cao đồng nhất */
        overflow: hidden;
    }
    .product-card-info .price { font-weight: bold; color: #d9534f; }

    /* Phân trang */
    .pagination { margin-top: 40px; display: flex; justify-content: center; }
</style>

<div class="product-page-container">

    {{-- CỘT BỘ LỌC BÊN TRÁI --}}
    <aside class="product-sidebar">
        <h3>BỘ LỌC</h3>

        <div class="filter-group">
            <h4>Kiểu Giày</h4>
            <ul>
                <li><a href="{{ route('products', request()->except('type')) }}" class="{{ !request('type') ? 'active' : '' }}">Tất cả</a></li>
                @foreach($shoeTypes as $type)
                    <li><a href="{{ route('products', array_merge(request()->query(), ['type' => $type->name])) }}" class="{{ request('type') == $type->name ? 'active' : '' }}">{{ $type->name }}</a></li>
                @endforeach
            </ul>
        </div>

        <div class="filter-group">
            <h4>Màu Sắc</h4>
            <div class="color-options">
                 @foreach($colors as $color)
                    <a href="{{ route('products', array_merge(request()->query(), ['color' => $color->name])) }}">
                        <span style="background-color: {{ $color->color_code }};" title="{{ $color->name }}" class="{{ request('color') == $color->name ? 'active' : '' }}"></span>
                    </a>
                @endforeach
            </div>
            @if(request('color'))
                <a href="{{ route('products', request()->except('color')) }}" style="font-size: 0.8em; text-decoration: none; margin-top: 5px; display:inline-block;">Xóa bộ lọc màu</a>
            @endif
        </div>
        
        <div class="filter-group">
            <h4>Mức Giá</h4>
            <ul>
                <li><a href="{{ route('products', array_merge(request()->query(), ['price_range' => '0-500000'])) }}" class="{{ request('price_range') == '0-500000' ? 'active' : '' }}">Dưới 500.000đ</a></li>
                <li><a href="{{ route('products', array_merge(request()->query(), ['price_range' => '500000-1000000'])) }}" class="{{ request('price_range') == '500000-1000000' ? 'active' : '' }}">500.000đ - 1.000.000đ</a></li>
                <li><a href="{{ route('products', array_merge(request()->query(), ['price_range' => '1000000'])) }}" class="{{ request('price_range') == '1000000' ? 'active' : '' }}">Trên 1.000.000đ</a></li>
                @if(request('price_range'))
                    <li><a href="{{ route('products', request()->except('price_range')) }}" style="font-size: 0.8em; text-decoration: none;">Xóa bộ lọc giá</a></li>
                @endif
            </ul>
        </div>
    </aside>

    {{-- LƯỚI SẢN PHẨM BÊN PHẢI --}}
    <div class="product-main-content">
        <div class="product-grid">
            @forelse($products as $product)
            <div class="product-card">
                <img src="{{ $product->variants->first()->image_url ?? 'https://via.placeholder.com/220x220.png?text=Biti\'s' }}" alt="{{ $product->name }}">
                <div class="product-card-info">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">{{ $product->variants->first() ? number_format($product->variants->first()->price, 0, ',', '.') . ' đ' : 'Liên hệ' }}</p>
                </div>
            </div>
            @empty
                <p>Không tìm thấy sản phẩm nào phù hợp với tiêu chí của bạn.</p>
            @endforelse
        </div>

        <div class="pagination">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection