<?php

namespace App\Modules\Purchase\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PurchaseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,

            'invoice_number' => $this->invoice_number,

            'supplier' => $this->whenLoaded(
                'supplier',
                fn () => [
                    'id' => $this->supplier->id,
                    'name' => $this->supplier->name,
                ]
            ),

            'user' => $this->whenLoaded(
                'user',
                fn () => [
                    'id' => $this->user->id,
                    'name' => $this->user->name,
                ]
            ),

            'subtotal' => (float) $this->subtotal,

            'discount' => (float) $this->discount,

            'tax' => (float) $this->tax,

            'grand_total' => (float) $this->grand_total,

            'payment_method' => $this->payment_method,

            'payment_status' => $this->payment_status,

            'notes' => $this->notes,

            'items' => $this->whenLoaded(
                'items',
                fn () => $this->items->map(
                    fn ($item) => [
                        'id' => $item->id,
                        'product_id' => $item->product_id,
                        'product_name' => $item->product?->name,
                        'qty' => $item->qty,
                        'price' => (float) $item->price,
                        'subtotal' => (float) $item->subtotal,
                    ]
                )->values()
            ),

            'created_at' => $this->created_at?->toISOString(),

            'updated_at' => $this->updated_at?->toISOString(),
        ];
    }
}