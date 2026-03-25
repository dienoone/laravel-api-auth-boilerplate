<?php

namespace App\Contracts\Repositories;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email): ?User;
    public function findById(int $id): ?User;
    public function create(array $data): ?User;
    public function update(User $user, array $data): ?User;
}
