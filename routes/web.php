<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BrandController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ProductVariantController;

Route::get('/', function () {
    return view('home');
})->name('home');

// Sửa route '/products' để sử dụng ProductController
Route::get('/products', [ProductController::class, 'index'])->name('products');


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
