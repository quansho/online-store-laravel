<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'price' => $this->price,
            'description' => $this->description,
            'available' => $this->available,
            'image_url' => $this->getFirstMediaUrl('product_image'), // Получение URL первого изображения
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
