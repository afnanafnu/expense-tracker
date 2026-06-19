<?php

namespace App\Repositories\Admin\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function getUsers(?string $search);
    public function query();
    public function toggleAdmin(User $user): User;
    public function delete(User $user): void;
    public function update(int $id, array $data): bool;
}