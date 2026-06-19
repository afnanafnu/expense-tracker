<?php

namespace App\Repositories\Web\Entry;

use App\Models\Entry;
use Illuminate\Pagination\LengthAwarePaginator;

class EntryRepository implements EntryRepositoryInterface
{
    public function getUserEntries(int $userId, int $perPage = 10): LengthAwarePaginator
    {
        return Entry::with('category')
            ->where('user_id', $userId)
            ->orderByDesc('transaction_date')
            ->orderByDesc('id')
            ->paginate($perPage);
    }

    public function create(array $data): Entry
    {
        return Entry::create($data);
    }

    public function update(Entry $entry, array $data): bool
    {
        return $entry->update($data);
    }

    public function delete(Entry $entry): bool
    {
        return $entry->delete();
    }
}
