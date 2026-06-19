<?php

namespace App\Repositories\Web\Entry;

use App\Models\Entry;
use Illuminate\Pagination\LengthAwarePaginator;

interface EntryRepositoryInterface
{
    public function getUserEntries(int $userId, int $perPage = 10): LengthAwarePaginator;
    public function create(array $data): Entry;
    public function update(Entry $entry, array $data): bool;
    public function delete(Entry $entry): bool;
}