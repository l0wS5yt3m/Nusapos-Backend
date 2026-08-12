<?php

namespace App\Services;

use App\Models\Purchase;
use App\Models\Transaction;

class InvoiceService
{
    public function generate(string $type = 'transaction'): string
    {
        $today = now()->format('Ymd');

        if ($type === 'purchase') {
            $model = Purchase::class;
            $prefix = 'PUR';
        } else {
            $model = Transaction::class;
            $prefix = 'INV';
        }

        $last = $model::whereDate(
            'created_at',
            today()
        )
            ->latest('id')
            ->first();

        $number = 1;

        if ($last) {
            $parts = explode('-', $last->invoice_number);

            $number = ((int) end($parts)) + 1;
        }

        return sprintf(
            '%s-%s-%06d',
            $prefix,
            $today,
            $number
        );
    }
}