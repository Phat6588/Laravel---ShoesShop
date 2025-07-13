<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource để chuyển đổi model Product thành JSON.
 *
 * Đã sửa các lỗi sau:
 * 1. Sửa 'id' thành 'productId' để trả về đúng khóa chính.
 * 2. Sửa 'shoe_type' thành 'shoeType' để khớp với tên quan hệ trong Model.
 * 3. Thay thế 'CategoryResource' bằng 'ShoeTypeResource' đã được sửa.
 */
class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'productId' => $this->productId,
            'name' => $this->name,
            'description' => $this->description,
            'brand' => new BrandResource($this->whenLoaded('brand')),
            'shoeType' => new ShoeTypeResource($this->whenLoaded('shoeType')),
            'variants' => ProductVariantResource::collection($this->whenLoaded('variants')),
        ];
    }
}
