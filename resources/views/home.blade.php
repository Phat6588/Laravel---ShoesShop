@extends('layouts.app')

@section('title', 'Trang Chủ - Cửa Hàng Giày Dép')

@section('content')
<div class="container">
    {{-- Slider Sản phẩm mới nhất --}}
    <section class="mb-5">
        <h2 class="mb-4">Sản Phẩm Mới Nhất</h2>
        <div id="newest-products-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($newestProducts->chunk(5) as $chunk)
                <div class="carousel-item @if($loop->first) active @endif" data-bs-interval="5000">
                    <div class="row">
                        @foreach($chunk as $variant)
                        <div class="col">
                            <div class="card product-card h-100">
                                <img src="{{ $variant->image_url }}" class="card-img-top" alt="{{ $variant->product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $variant->product->name }}</h5>
                                    <p class="card-text text-muted">{{ $variant->product->brand->name }}</p>
                                    <p class="card-text product-price">{{ number_format($variant->price, 0, ',', '.') }} ₫</p>
                                    <a href="#" class="btn btn-primary w-100">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#newest-products-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#newest-products-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    {{-- Slider Sản phẩm bán chạy nhất --}}
    <section class="mb-5">
        <h2 class="mb-4">Sản Phẩm Bán Chạy</h2>
        <div id="bestselling-products-carousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach($bestSellingProducts->chunk(5) as $chunk)
                <div class="carousel-item @if($loop->first) active @endif" data-bs-interval="5500">
                    <div class="row">
                        @foreach($chunk as $variant)
                        <div class="col">
                            <div class="card product-card h-100">
                                <img src="{{ $variant->image_url }}" class="card-img-top" alt="{{ $variant->product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $variant->product->name }}</h5>
                                    <p class="card-text text-muted">{{ $variant->product->brand->name }}</p>
                                    <p class="card-text product-price">{{ number_format($variant->price, 0, ',', '.') }} ₫</p>
                                    <a href="#" class="btn btn-primary w-100">Xem Chi Tiết</a>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endforeach
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#bestselling-products-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#bestselling-products-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>
</div>
@endsection
