<?php

namespace App\Services;

use App\Models\InvoiceSequence;
use Carbon\Carbon;

class InvoiceService
{
    public function generate(string $type = 'transaction'): string
    {
        $date = Carbon::today();

        $prefix = match ($type) {
            'purchase' => 'PUR',
            'transaction' => 'INV',
            default => throw new \InvalidArgumentException(
                "Tipe invoice '{$type}' tidak valid."
            ),
        };

        $sequence = InvoiceSequence::where('type', $type)
            ->whereDate('sequence_date', $date)
            ->lockForUpdate()
            ->first();

        if (! $sequence) {
          InvoiceSequence::createOrFirst(
        [
            'type' => $type,
            'sequence_date' => $date,
        ],
        [
            'last_number' => 0,
        ]
        );

        $sequence = InvoiceSequence::where('type', $type)
        ->whereDate('sequence_date', $date)
        ->lockForUpdate()
        ->firstOrFail();
        }

        $sequence->increment('last_number');

        return sprintf(
            '%s-%s-%06d',
            $prefix,
            $date->format('Ymd'),
            $sequence->last_number
        );
    }
}
