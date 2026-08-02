<?php

namespace App\Repositories;

use App\Models\User;

class AuthRepository
{
    /**
     * Cari user berdasarkan email.
     */
    public function findByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }
}