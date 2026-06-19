<?php

namespace App\Repositories\Admin\User;

use App\Models\User;

class UserRepository implements UserRepositoryInterface
{
    public function getUsers(?string $search)
    {
        return User::where('role', '!=', 'admin')
            ->when($search, function ($q) use ($search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%");
                });
            })
            ->withCount('entries')
            ->latest()
            ->paginate(20)
            ->withQueryString();
    }

    public function query()
    {
        return User::where('role', '!=', 'admin');
    }

    public function toggleAdmin(User $user): User
    {
        // FIX: using role instead of is_admin
        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return $user;
    }

    public function delete(User $user): void
    {
        $user->delete();
    }

    public function update(int $id, array $data): bool
    {
        $user = User::findOrFail($id);

        return $user->update([
            'name'  => $data['name'],
            'email' => $data['email'],
            'role'  => $data['role'],
        ]);
    }
}
