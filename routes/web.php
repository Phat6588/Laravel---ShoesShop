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

// Route cho trang sản phẩm, trỏ đến ProductController
Route::get('/products', [ProductController::class, 'index'])->name('products.index');


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
