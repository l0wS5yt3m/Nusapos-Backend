<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InvoiceSequence extends Model
{
    protected $fillable = [
        'type',
        'sequence_date',
        'last_number',
    ];

    protected function casts(): array
    {
        return [
            'sequence_date' => 'date',
            'last_number' => 'integer',
        ];
    }
}