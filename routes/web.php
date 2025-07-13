<?php

use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;


// Route cho trang chủ, trỏ đến HomeController
// Route cho trang chủ, trỏ đến HomeController
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route cho trang chi tiết sản phẩm
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');


// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/api/brands', [BrandController::class, 'index']);

// Route::get('/api/brands/{brandId}', [BrandController::class, 'show']);
// Route::apiResource('brands', BrandController::class);
// Route::apiResource('categories', CategoryController::class);
// Route::apiResource('products', ProductController::class);
// Route::apiResource('variants', ProductVariantController::class); // product-variants
// Route::apiResource('orders', OrderController::class)->except(['destroy']);
