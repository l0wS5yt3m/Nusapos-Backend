<?php

namespace App\Modules\Transaction\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                 => $this->id,
            'invoice_number'     => $this->invoice_number,

            'customer'           => $this->customer,

            'user'               => $this->user,

            'subtotal'           => $this->subtotal,

            'discount'           => $this->discount,

            'tax'                => $this->tax,

            'grand_total'        => $this->grand_total,

            'payment_method'     => $this->payment_method,

            'payment_status'     => $this->payment_status,

            'transaction_status' => $this->transaction_status,

            'notes'              => $this->notes,

            'items'              => $this->whenLoaded('items'),

            'created_at'         => $this->created_at,
        ];
    }
}