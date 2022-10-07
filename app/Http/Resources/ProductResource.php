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
//        var_dump($this->name);
//        exit();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'in_stock' => $this->in_stock,
            'rating' => $this->rating,
            'category' => array_map(function ($category){
                return $category['id'];
            }, $this->Category()->get()->toArray()),
            'images' => array_map(function ($image){
                return $image['filename'];
            }, $this->ProductImages()->get()->toArray())
        ];
    }
}
