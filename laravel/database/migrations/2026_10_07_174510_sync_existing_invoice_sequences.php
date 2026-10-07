<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $syncSequences = function (
            string $table,
            string $prefix,
            string $type
        ): void {
            $invoices = DB::table($table)
                ->select('invoice_number')
                ->where('invoice_number', 'like', "{$prefix}-%")
                ->get();

            $sequences = [];

            foreach ($invoices as $invoice) {
                if (! preg_match(
                    "/^{$prefix}-(\d{8})-(\d{6})$/",
                    $invoice->invoice_number,
                    $matches
                )) {
                    continue;
                }

                $date = $matches[1];
                $number = (int) $matches[2];

                if (! isset($sequences[$date]) || $number > $sequences[$date]) {
                    $sequences[$date] = $number;
                }
            }

            foreach ($sequences as $date => $lastNumber) {
                $sequence = DB::table('invoice_sequences')
                    ->where('type', $type)
                    ->where('sequence_date', $date)
                    ->first();

                if (! $sequence) {
                    DB::table('invoice_sequences')->insert([
                        'type' => $type,
                        'sequence_date' => $date,
                        'last_number' => $lastNumber,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    continue;
                }

                if ($lastNumber > $sequence->last_number) {
                    DB::table('invoice_sequences')
                        ->where('id', $sequence->id)
                        ->update([
                            'last_number' => $lastNumber,
                            'updated_at' => now(),
                        ]);
                }
            }
        };

        $syncSequences(
            'transactions',
            'INV',
            'transaction'
        );

        $syncSequences(
            'purchases',
            'PUR',
            'purchase'
        );
    }

    public function down(): void
    {
        // Data backfill tidak dihapus saat rollback.
    }
};
