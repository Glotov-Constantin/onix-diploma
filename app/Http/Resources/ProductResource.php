<?php

namespace App\Http\Resources;

use App\Models\ProductImage;
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
            'description' => $this->description,
            'in_stock' => $this->in_stock,
            'rating' => $this->rating,
            'price' => $this->price,
            'categories' => $this->whenLoaded('categories', fn() => $this->categories),
//            'images'=> $this->whenLoaded('ProductImages', fn () => $this->productImages->pluck('filename')),
            'images' => array_map(function ($image){
                return $image['filename'];
            }, $this->ProductImages()->get()->toArray())
            // !Dab!            'category' => $this->whenLoaded('categories', function() => $this->categories),
//        'images'=> $this->whenLoaded('ProductImages', function () => $this->productImages->pluck('filename')),
        ];
    }
}
