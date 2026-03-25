<?php

namespace App\Services;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    public function register(array $data): User
    {
        return $this->authRepository->create([
            'name' => data_get($data, 'name'),
            'email' => data_get($data, 'email'),
            'password' => Hash::make(data_get($data, 'password'))
        ]);
    }

    public function login(array $data): array
    {
        $user = $this->authRepository->findByEmail(data_get($data, 'email'));

        throw_if(
            !$user || !Hash::check(data_get($data, 'password'), $user->password),
            AuthenticationException::class,
            'Invalid credentials'
        );

        $token = $user->createToken('auth_token')->plainTextToken;

        return [
            'user' => $user,
            'token' => $token
        ];
    }

    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }

    public function me(User $user): User
    {
        return $user;
    }
}
