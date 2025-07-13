@extends('layouts.app')

@section('content')
<div class="container">
    {{-- Phần sản phẩm bán chạy nhất --}}
    <section class="mt-5">
        <h2 class="text-center mb-4">Sản Phẩm Bán Chạy</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            @forelse ($bestSellers as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product->image ?? 'https://placehold.co/600x700/EFEFEF/AAAAAA&text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text fw-bold text-danger">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            <a href="#" class="btn btn-outline-primary stretched-link">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Hiện chưa có sản phẩm bán chạy nào.</p>
                </div>
            @endforelse
        </div>
        {{-- Phân trang cho sản phẩm bán chạy --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $bestSellers->withQueryString()->links() }}
        </div>
    </section>

    <hr class="my-5">

    {{-- Phần sản phẩm mới --}}
    <section class="mb-5">
        <h2 class="text-center mb-4">Sản Phẩm Mới</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">
            @forelse ($newProducts as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ $product->image ?? 'https://placehold.co/600x700/EFEFEF/AAAAAA&text=No+Image' }}" class="card-img-top" alt="{{ $product->name }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $product->name }}</h5>
                            <p class="card-text fw-bold text-danger">{{ number_format($product->price, 0, ',', '.') }} VNĐ</p>
                            <a href="#" class="btn btn-outline-primary stretched-link">Xem chi tiết</a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p class="text-center text-muted">Hiện chưa có sản phẩm mới nào.</p>
                </div>
            @endforelse
        </div>
        {{-- Phân trang cho sản phẩm mới --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $newProducts->withQueryString()->links() }}
        </div>
    </section>
</div>
@endsection
