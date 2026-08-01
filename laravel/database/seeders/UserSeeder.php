<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::firstOrCreate(
            [
                'email' => 'owner@nusapos.test',
            ],
            [
                'name' => 'Owner NusaPOS',
                'password' => Hash::make('password'),
            ]
        );

        $owner->assignRole('Owner');
    }
}