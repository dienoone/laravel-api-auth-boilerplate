<?php

namespace App\Contracts\Services;

use App\Models\User;

interface AuthServiceInterface
{
    public function register(array $data): User;
    public function login(array $data): array;
    public function logout(User $user): void;
    public function me(User $user): User;
}
