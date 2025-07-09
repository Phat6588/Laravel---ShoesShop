@extends('layouts.app')

{{-- Đặt tiêu đề cho trang --}}
@section('title', 'Biti\'s - Nâng niu bàn chân Việt')

{{-- Định nghĩa phần nội dung --}}
@section('content')
<div class="container">

    {{-- Banner chính --}}
    <div class="banner" style="margin-bottom: 40px; text-align: center;">
        <img src="https://file.hstatic.net/200000522597/file/web_-_desktop_8f44cf326d744b4c84a8a652a926a350.jpg" alt="Banner Biti's" style="width: 100%; height: auto; border-radius: 8px;">
    </div>

    {{-- Khu vực sản phẩm nổi bật --}}
    <h2 style="text-align: center; margin-bottom: 30px;">SẢN PHẨM NỔI BẬT</h2>
    <div class="product-grid" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px;">
        
        {{-- Placeholder cho 4 sản phẩm --}}
        @for ($i = 0; $i < 4; $i++)
            <div class="product-card" style="background-color: #fff; border: 1px solid #ddd; border-radius: 8px; text-align: center; padding: 15px;">
                <img src="https://via.placeholder.com/250x250.png?text=Biti's+Hunter" alt="Sản phẩm" style="width: 100%; height: auto; border-radius: 4px;">
                <h3 style="font-size: 1.1em; margin: 15px 0 10px;">Biti's Hunter X 2024</h3>
                <p style="color: #d9534f; font-weight: bold;">950,000 đ</p>
                <a href="#" style="display: inline-block; margin-top: 10px; padding: 8px 20px; background-color: #337ab7; color: white; text-decoration: none; border-radius: 4px;">Xem chi tiết</a>
            </div>
        @endfor

    </div>

</div>
@endsection