<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'brand_id' => $this->brand_id,
            'brand_name' => $this->brand_name,
            // Bạn có thể thêm các dữ liệu khác nếu cần
        ];
    }
}
