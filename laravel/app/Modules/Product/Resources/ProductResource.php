<?php

namespace App\Modules\Product\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     */
    public function toArray(Request $request): array
    {
        return [

            'id' => $this->id,

            'category_id' => $this->whenLoaded('category',function (){
                return [
                    'id' => $this->category->id,
                    'name' => $this->category->name,
                ];
            }),

            'sku' => $this->sku,

            'barcode' => $this->barcode,

            'name' => $this->name,

            'slug' => $this->slug,

            'description' => $this->description,

            'cost_price' => $this->cost_price,

            'selling_price' => $this->selling_price,

            'stock' => $this->stock,

            'minimum_stock' => $this->minimum_stock,

            'image' => $this->image,

            'status' => $this->status,

            'created_at' => $this->created_at,

            'updated_at' => $this->updated_at,

        ];
    }
}