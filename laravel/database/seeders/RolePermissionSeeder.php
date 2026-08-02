<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RolePermissionSeeder extends Seeder
{

    public function run(): void
    {


        // OWNER
        $owner = Role::findByName('owner');

        $owner->syncPermissions(
            Permission::all()
        );



        // ADMIN
        $admin = Role::findByName('admin');

        $admin->syncPermissions(
            Permission::all()
        );



        // CASHIER

        $cashier = Role::findByName('cashier');

        $cashier->syncPermissions([

            'category.view',

            'product.view',

            'customer.view',
            'customer.create',
            'customer.update',
            'customer.delete',

            'transaction.view',
            'transaction.create',
            'transaction.update',
            'transaction.delete',

        ]);




        // KITCHEN

        $kitchen = Role::findByName('kitchen');

        $kitchen->syncPermissions([

            'category.view',

            'product.view',

            'transaction.view',
            'transaction.status',

        ]);


    }

}