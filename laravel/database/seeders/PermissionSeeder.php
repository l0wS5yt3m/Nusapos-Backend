<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [

            // Category
            'category.view',
            'category.create',
            'category.update',
            'category.delete',

            // Product
            'product.view',
            'product.create',
            'product.update',
            'product.delete',

            // Customer
            'customer.view',
            'customer.create',
            'customer.update',
            'customer.delete',

            // Transaction
            'transaction.view',
            'transaction.create',
            'transaction.update',
            'transaction.delete',
            'transaction.status',

        ];


        foreach ($permissions as $permission) {

            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web'
            ]);

        }
    }
}