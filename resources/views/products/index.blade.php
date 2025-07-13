@extends('layouts.app')

@section('title', 'Tất cả sản phẩm')

@push('styles')
<style>
    /* CSS cho bộ lọc dính (sticky) trên màn hình lớn */
    @media (min-width: 1024px) {
        .sidebar-sticky {
            position: sticky;
            top: 2rem; /* Khoảng cách với top */
            height: calc(100vh - 4rem); /* Chiều cao tối đa */
            overflow-y: auto;
        }
    }
    /* Cải thiện giao diện scrollbar cho bộ lọc */
    .filter-scroll::-webkit-scrollbar {
        width: 6px;
    }
    .filter-scroll::-webkit-scrollbar-track {
        background: #f1f1f1;
    }
    .filter-scroll::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 3px;
    }
    .filter-scroll::-webkit-scrollbar-thumb:hover {
        background: #555;
    }
    .filter-option {
        display: flex;
        align-items: center;
        margin-bottom: 0.5rem;
    }
    .filter-option input {
        margin-right: 0.75rem;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- Header của trang sản phẩm --}}
    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 border-b pb-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-800">Tất cả sản phẩm</h1>
            <p class="text-gray-600 mt-1">
                Hiển thị {{ $products->firstItem() }}-{{ $products->lastItem() }} trên tổng số {{ $products->total() }} sản phẩm
            </p>
        </div>
        {{-- Nút Lọc cho Mobile --}}
        <button id="filter-toggle" class="lg:hidden w-full sm:w-auto mt-4 sm:mt-0 px-4 py-2 bg-gray-800 text-white font-semibold rounded-md shadow-md hover:bg-gray-900">
            Lọc sản phẩm
        </button>
    </div>


    <div class="lg:grid lg:grid-cols-4 lg:gap-8">
        {{-- Cột Bộ lọc --}}
        <aside id="filter-sidebar" class="hidden lg:block lg:col-span-1">
            <div class="lg:sidebar-sticky">
                <form id="filter-form" action="{{ route('products.index') }}" method="GET">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-bold">Bộ lọc</h2>
                        {{-- Nút đóng cho mobile --}}
                        <button type="button" id="filter-close" class="lg:hidden text-2xl font-bold">&times;</button>
                    </div>

                    {{-- Sắp xếp --}}
                    <div class="mb-6">
                        <label for="sort_by" class="block text-lg font-semibold mb-2">Sắp xếp</label>
                        <select name="sort_by" id="sort_by" class="w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" onchange="this.form.submit();">
                            <option value="">Mặc định</option>
                            <option value="price_asc" @if($selectedSort == 'price_asc') selected @endif>Giá: Tăng dần</option>
                            <option value="price_desc" @if($selectedSort == 'price_desc') selected @endif>Giá: Giảm dần</option>
                        </select>
                    </div>

                    {{-- Các mục lọc --}}
                    <div class="space-y-6">
                        {{-- Lọc theo Thương hiệu --}}
                        <div>
                            <h3 class="text-lg font-semibold mb-3 border-b pb-2">Thương hiệu</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto filter-scroll pr-2">
                                @foreach($brands as $brand)
                                    <div class="filter-option">
                                        <input type="checkbox" name="brands[]" id="brand-{{ $brand->id }}" value="{{ $brand->id }}" @if(in_array($brand->id, $selectedBrands)) checked @endif class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="brand-{{ $brand->id }}" class="text-gray-700 cursor-pointer">{{ $brand->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Lọc theo Kích cỡ --}}
                        <div>
                            <h3 class="text-lg font-semibold mb-3 border-b pb-2">Kích cỡ</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto filter-scroll pr-2">
                                @foreach($sizes as $size)
                                    <div class="filter-option">
                                        <input type="checkbox" name="sizes[]" id="size-{{ $size->id }}" value="{{ $size->id }}" @if(in_array($size->id, $selectedSizes)) checked @endif class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="size-{{ $size->id }}" class="text-gray-700 cursor-pointer">{{ $size->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        {{-- Lọc theo Màu sắc --}}
                        <div>
                            <h3 class="text-lg font-semibold mb-3 border-b pb-2">Màu sắc</h3>
                            <div class="space-y-2 max-h-48 overflow-y-auto filter-scroll pr-2">
                                @foreach($colors as $color)
                                    <div class="filter-option">
                                        <input type="checkbox" name="colors[]" id="color-{{ $color->id }}" value="{{ $color->id }}" @if(in_array($color->id, $selectedColors)) checked @endif class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="color-{{ $color->id }}" class="text-gray-700 cursor-pointer">{{ $color->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    {{-- Nút áp dụng và xóa bộ lọc --}}
                    <div class="flex space-x-2 mt-8 border-t pt-4">
                        <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-75 transition-colors">
                            Áp dụng
                        </button>
                        <a href="{{ route('products.index') }}" class="flex-1 px-4 py-2 bg-gray-300 text-gray-800 font-semibold rounded-md shadow-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-75 text-center transition-colors">
                            Xóa lọc
                        </a>
                    </div>
                </form>
            </div>
        </aside>

        {{-- Lưới sản phẩm --}}
        <main class="lg:col-span-3 mt-8 lg:mt-0">
            @if($products->isNotEmpty())
                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-x-6 gap-y-10">
                    @foreach($products as $product)
                        <div class="group bg-white border rounded-lg overflow-hidden shadow-sm hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                            <a href="#" class="block overflow-hidden"> {{-- TODO: Thay bằng route chi tiết sản phẩm sau này --}}
                                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://placehold.co/400x400/e2e8f0/adb5bd?text=H%C3%ACnh+%E1%BA%A3nh' }}"
                                     alt="Ảnh sản phẩm {{ $product->name }}"
                                     class="w-full h-64 object-cover transition-transform duration-300 group-hover:scale-105">
                            </a>
                            <div class="p-4 flex flex-col flex-grow">
                                <p class="text-sm text-gray-500 mb-1">{{ $product->brand->name ?? 'Không có thương hiệu' }}</p>
                                <h4 class="text-md font-semibold text-gray-800 truncate flex-grow" title="{{ $product->name }}">
                                    <a href="#" class="hover:text-indigo-600">{{ $product->name }}</a>
                                </h4>
                                <p class="text-lg font-bold text-red-600 mt-2">{{ number_format($product->price, 0, ',', '.') }} ₫</p>
                                <a href="#" class="mt-4 w-full block text-center bg-indigo-600 text-white py-2 rounded-md hover:bg-indigo-700 transition-colors duration-300">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                 {{-- Phân trang --}}
                <div class="mt-8">
                    {{ $products->appends(request()->query())->links() }}
                </div>
            @else
                <div class="col-span-full text-center py-16 bg-gray-50 rounded-lg">
                    <p class="text-2xl text-gray-500">Không tìm thấy sản phẩm nào phù hợp.</p>
                    <a href="{{ route('products.index') }}" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700">
                        Xóa bộ lọc và thử lại
                    </a>
                </div>
            @endif
        </main>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const filterToggle = document.getElementById('filter-toggle');
        const filterSidebar = document.getElementById('filter-sidebar');
        const filterClose = document.getElementById('filter-close');

        if (filterToggle && filterSidebar && filterClose) {
            filterToggle.addEventListener('click', function () {
                filterSidebar.classList.remove('hidden');
                filterSidebar.classList.add('block');
            });

            filterClose.addEventListener('click', function () {
                filterSidebar.classList.add('hidden');
                filterSidebar.classList.remove('block');
            });
        }
    });
</script>
@endpush
