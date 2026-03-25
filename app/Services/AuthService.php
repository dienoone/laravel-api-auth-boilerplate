<?php

namespace App\Services;

use App\Contracts\Repositories\AuthRepositoryInterface;
use App\Contracts\Services\AuthServiceInterface;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\AuthenticationException;

class AuthService implements AuthServiceInterface
{
    public function __construct(
        protected AuthRepositoryInterface $authRepository
    ) {}

    public function register(array $data): User
    {
        $user = $this->authRepository->create([
            'name' => data_get($data, 'name'),
            'email' => data_get($data, 'email'),
            'password' => Hash::make(data_get($data, 'password'))
        ]);

        $user->sendEmailVerificationNotification();

        return $user;
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

    public function verifyEmail(int $id, string $hash): bool
    {
        $user = $this->authRepository->findById($id);

        throw_if(
            !$user,
            AuthorizationException::class,
            'User not found.'
        );

        throw_if(
            !hash_equals(sha1($user->email), $hash),
            AuthorizationException::class,
            'Invalid verification link.'
        );

        if ($user->hasVerifiedEmail()) {
            return false;
        }

        $this->authRepository->markEmailAsVerified($user);

        return true;
    }

    public function resendVerification(User $user): void
    {

        throw_if(
            $user->hasVerifiedEmail(),
            \Exception::class,
            'Email is already verified.'
        );

        $user->sendEmailVerificationNotification();
    }
}
