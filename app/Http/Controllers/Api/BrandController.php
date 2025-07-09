<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Resources\BrandResource;

class BrandController extends Controller
{
    /**
     * Lấy danh sách tất cả thương hiệu.
     */
    public function index()
    {
        return Brand::all();
    }

    /**
     * Tạo một thương hiệu mới.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string|unique:brands|max:100',
            'brand_logo_url' => 'nullable|url',
        ]);

        $brand = Brand::create($validatedData);

        return response()->json($brand, Response::HTTP_CREATED);
    }

    /**
     * Lấy thông tin chi tiết một thương hiệu.
     */
    public function show(Brand $brand)
    {
        return new BrandResource($brand);
    }

    /**
     * Cập nhật thông tin thương hiệu.
     */
    public function update(Request $request, Brand $brand)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string|max:100|unique:brands,brand_name,' . $brand->id,
            'brand_logo_url' => 'nullable|url',
        ]);

        $brand->update($validatedData);

        return response()->json($brand);
    }

    /**
     * Xóa một thương hiệu.
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();

        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}
