@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
    <!-- Main-body -->
    <div class="main-body">
        <div class="container">
            <!-- New-product -->
            <div class="new-product">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>Sản phẩm mới</h2>
                        </div>
                    </div>
                    @if(isset($newProducts) && $newProducts->count() > 0)
                        @foreach($newProducts as $product)
                            <div class="col-md-3 col-sm-6">
                                <div class="product-item">
                                    <div class="product-item-image">
                                        <a href="{{ route('products.show', $product) }}">
                                            <img src="https://placehold.co/600x600/EFEFEF/333?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="product-item-body">
                                        <div class="product-item-title">
                                            <a href="{{ route('products.show', $product) }}">
                                                <h3>{{ $product->name }}</h3>
                                                <p>Kiểu giày: {{ optional($product->shoeType)->name }}</p>
                                            </a>
                                        </div>
                                        <div class="product-item-price">
                                            <span>{{ number_format(optional($product->variants->first())->price ?? 0, 0, ',', '.') }} VND</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="col-12">Chưa có sản phẩm mới.</p>
                    @endif
                </div>
            </div>
            <!-- End-new-product -->

            <!-- product-featured -->
            <div class="product-featured">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-title">
                            <h2>Sản phẩm nổi bật</h2>
                        </div>
                    </div>
                     @if(isset($featuredProducts) && $featuredProducts->count() > 0)
                        @foreach($featuredProducts as $product)
                            <div class="col-md-3 col-sm-6">
                                <div class="product-item">
                                    <div class="product-item-image">
                                        <a href="{{ route('products.show', $product) }}">
                                             <img src="https://placehold.co/600x600/EFEFEF/333?text={{ urlencode($product->name) }}" alt="{{ $product->name }}" class="img-responsive">
                                        </a>
                                    </div>
                                    <div class="product-item-body">
                                        <div class="product-item-title">
                                            <a href="{{ route('products.show', $product) }}">
                                                <h3>{{ $product->name }}</h3>
                                                <p>Kiểu giày: {{ optional($product->shoeType)->name }}</p>
                                            </a>
                                        </div>
                                        <div class="product-item-price">
                                            <span>{{ number_format(optional($product->variants->first())->price ?? 0, 0, ',', '.') }} VND</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <p class="col-12">Chưa có sản phẩm nổi bật.</p>
                    @endif
                </div>
            </div>
            <!-- End-product-featured -->
        </div>
    </div>
    <!-- End-main-body -->
@endsection
