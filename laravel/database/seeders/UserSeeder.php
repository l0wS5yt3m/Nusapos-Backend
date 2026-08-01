<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $owner = User::create([
            'name' => 'Owner NusaPOS',
            'email' => 'owner@nusapos.test',
            'password' => Hash::make('password'),
        ]);

        $owner->assignRole('Owner');
    }
}