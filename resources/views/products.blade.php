@extends('layouts.app')

@section('title', 'Sản Phẩm')

@section('content')
    <!-- Main-body -->
    <div class="main-body">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <div class="category-sidebar">
                        <div class="widget-title">
                            <h3>Kiểu giày</h3>
                        </div>
                        <div class="widget-content">
                            <ul>
                                @if(isset($shoeTypes) && $shoeTypes->count() > 0)
                                    @foreach($shoeTypes as $shoeType)
                                        <li>
                                            <a href="{{ request()->fullUrlWithQuery(['category' => $shoeType->typeId]) }}">
                                                {{ $shoeType->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Không có dữ liệu</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="brand-sidebar">
                        <div class="widget-title">
                            <h3>Thương hiệu</h3>
                        </div>
                        <div class="widget-content">
                            <ul>
                                @if(isset($brands) && $brands->count() > 0)
                                    @foreach($brands as $brand)
                                        <li>
                                            <a href="{{ request()->fullUrlWithQuery(['brand' => $brand->brandId]) }}">
                                                {{ $brand->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                @else
                                    <li>Không có dữ liệu</li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-md-9">
                    <div class="product-list">
                        <div class="row">
                            @if(isset($products) && $products->count() > 0)
                                @foreach($products as $product)
                                    <div class="col-md-4 col-sm-6">
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
                                <div class="col-12">
                                    <p>Không tìm thấy sản phẩm nào phù hợp.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Pagination -->
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                {!! $products->links() !!}
                            </div>
                        </div>
                        <!-- End-pagination -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End-main-body -->
@endsection
