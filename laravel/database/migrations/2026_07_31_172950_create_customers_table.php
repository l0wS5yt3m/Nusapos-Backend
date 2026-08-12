<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {

            $table->id();

            $table->string('code',30)->unique();

            $table->string('name',150);

            $table->string('phone',20)->nullable();

            $table->string('email')->nullable()->unique();

            $table->text('address')->nullable();

            $table->integer('point')->default(0);

            $table->boolean('status')->default(true);

            $table->timestamps();

            $table->index('name');
            $table->index('phone');
            $table->index('status');

        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};