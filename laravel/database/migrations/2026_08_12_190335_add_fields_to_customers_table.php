<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->string('code', 30)
                ->unique()
                ->after('id');

            $table->string('name', 150)
                ->after('code');

            $table->string('phone', 20)
                ->nullable()
                ->after('name');

            $table->string('email')
                ->nullable()
                ->unique()
                ->after('phone');

            $table->text('address')
                ->nullable()
                ->after('email');

            $table->integer('point')
                ->default(0)
                ->after('address');

            $table->boolean('status')
                ->default(true)
                ->after('point');

            $table->index('name');
            $table->index('phone');
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {

            $table->dropUnique([
                'code',
            ]);

            $table->dropUnique([
                'email',
            ]);

            $table->dropIndex([
                'name',
            ]);

            $table->dropIndex([
                'phone',
            ]);

            $table->dropIndex([
                'status',
            ]);

            $table->dropColumn([
                'code',
                'name',
                'phone',
                'email',
                'address',
                'point',
                'status',
            ]);
        });
    }
};