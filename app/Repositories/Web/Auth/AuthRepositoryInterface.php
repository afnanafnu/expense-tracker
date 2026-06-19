<?php

namespace App\Repositories\Web\Auth;

use App\Models\User;

interface AuthRepositoryInterface
{
    public function register(array $data): User;
    public function login(array $credentials): bool;
    public function logout(): void;
}