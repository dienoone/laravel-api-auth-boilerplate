<?php

namespace App\Contracts\Services;

use App\Models\User;

interface AuthServiceInterface
{
    public function register(array $data): User;
    public function login(array $data): array;
    public function logout(User $user): void;
    public function me(User $user): User;
    public function verifyEmail(int $id, string $hash): bool;
    public function resendVerification(User $user): void;
}
