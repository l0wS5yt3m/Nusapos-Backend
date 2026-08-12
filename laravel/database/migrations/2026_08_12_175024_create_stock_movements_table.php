<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stock_movements', function (Blueprint $table) {
            $table->id();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('reference_type');

            $table->unsignedBigInteger('reference_id');

            $table->enum('type', [
                'IN',
                'OUT',
                'ADJUSTMENT',
            ]);

            $table->integer('qty');

            $table->integer('stock_before');

            $table->integer('stock_after');

            $table->string('notes')
                ->nullable();

            $table->timestamps();

            $table->index('product_id');

            $table->index('type');

            $table->index(
                ['reference_type', 'reference_id'],
                'stock_movements_reference_index'
            );
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_movements');
    }
};