@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        {{-- Sidebar Bộ lọc --}}
        <aside class="col-lg-3">
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0">Bộ lọc</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('products.index') }}" method="GET">
                        {{-- Sắp xếp theo giá --}}
                        <div class="mb-4">
                            <h5 class="mb-3">Sắp xếp theo giá</h5>
                            <select name="sort_price" class="form-select">
                                <option value="">Mặc định</option>
                                <option value="asc" {{ request('sort_price') == 'asc' ? 'selected' : '' }}>Giá: Tăng dần</option>
                                <option value="desc" {{ request('sort_price') == 'desc' ? 'selected' : '' }}>Giá: Giảm dần</option>
                            </select>
                        </div>

                        {{-- Lọc theo màu sắc --}}
                        <div class="mb-4">
                            <h5 class="mb-3">Màu sắc</h5>
                            @forelse ($colors as $color)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="colors[]" value="{{ $color->id }}" id="color_{{ $color->id }}"
                                        {{ in_array($color->id, request('colors', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="color_{{ $color->id }}">
                                        {{ $color->name }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted small">Không có lựa chọn</p>
                            @endforelse
                        </div>

                        {{-- Lọc theo kích thước --}}
                        <div class="mb-4">
                            <h5 class="mb-3">Kích thước</h5>
                            @forelse ($sizes as $size)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="sizes[]" value="{{ $size->id }}" id="size_{{ $size->id }}"
                                        {{ in_array($size->id, request('sizes', [])) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="size_{{ $size->id }}">
                                        {{ $size->name }}
                                    </label>
                                </div>
                            @empty
                                <p class="text-muted small">Không có lựa chọn</p>
                            @endforelse
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Áp dụng</button>
                            <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Xóa bộ lọc</a>
                        </div>
                    </form>
                </div>
            </div>
        </aside>

        {{-- Danh sách sản phẩm --}}
        <main class="col-lg-9">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
                @forelse ($products as $product)
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
                        <div class="alert alert-warning text-center">
                            Không tìm thấy sản phẩm nào phù hợp với tiêu chí của bạn.
                        </div>
                    </div>
                @endforelse
            </div>

            {{-- Phân trang --}}
            <div class="d-flex justify-content-center mt-4">
                {{-- Các link phân trang đã tự động chứa tham số filter nhờ withQueryString() --}}
                {{ $products->links() }}
            </div>
        </main>
    </div>
</div>
@endsection
