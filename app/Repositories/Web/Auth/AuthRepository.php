<?php

namespace App\Repositories\Web\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthRepository implements AuthRepositoryInterface
{
    public function register(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'user',
        ]);
    }

    public function login(array $credentials): bool
    {
        $credentials['role'] = 'user';

        return Auth::attempt($credentials);
    }

    public function logout(): void
    {
        Auth::logout();
    }
}