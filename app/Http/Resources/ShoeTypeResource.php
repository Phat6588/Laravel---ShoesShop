<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource cho ShoeType.
 * QUAN TRỌNG: Hãy đổi tên file từ CategoryResource.php thành ShoeTypeResource.php
 *
 * Đã sửa các lỗi sau:
 * 1. Đổi tên class từ 'CategoryResource' thành 'ShoeTypeResource'.
 * 2. Sửa 'id' thành 'typeId' để trả về đúng khóa chính của bảng ShoeTypes.
 */
class ShoeTypeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->typeId,
            'name' => $this->name,
        ];
    }
}
