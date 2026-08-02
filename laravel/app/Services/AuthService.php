<?php

namespace App\Services;

use App\Repositories\AuthRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{
    public function __construct(
        protected AuthRepository $repository
    ) {}

    /**
     * Login user.
     */
    public function login(array $data): array
    {
        $user = $this->repository->findByEmail($data['email']);

        if (!$user || !Hash::check($data['password'], $user->password)) {

            throw ValidationException::withMessages([
                'email' => [
                    'Email atau password salah.'
                ],
            ]);

        }

        $token = $user->createToken('nusapos')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token,
        ];
    }

    /**
     * Logout user.
     */
    public function logout($user): void
    {
        $user->currentAccessToken()->delete();
    }
}