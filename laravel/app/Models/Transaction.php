<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    protected $fillable = [

        'invoice_number',

        'customer_id',

        'user_id',

        'subtotal',

        'discount',

        'tax',

        'grand_total',

        'payment_method',

        'payment_status',

        'transaction_status',

        'notes',

    ];

    protected function casts(): array
    {
        return [

            'subtotal' => 'decimal:2',

            'discount' => 'decimal:2',

            'tax' => 'decimal:2',

            'grand_total' => 'decimal:2',

        ];
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class);
    }
}