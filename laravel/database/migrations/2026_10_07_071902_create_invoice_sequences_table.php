<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoice_sequences', function (Blueprint $table) {
            $table->id();

            $table->string('type', 20);

            $table->date('sequence_date');

            $table->unsignedInteger('last_number')->default(0);

            $table->timestamps();

            $table->unique(
                ['type', 'sequence_date'],
                'invoice_sequences_type_date_unique'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoice_sequences');
    }
};