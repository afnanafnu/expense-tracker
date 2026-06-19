<?php

namespace App\Repositories\Web\Report;

use App\Models\Entry;
use Illuminate\Support\Collection;

class ReportRepository implements ReportRepositoryInterface
{
    public function expensesByCategory(int $userId, int $year, int $month)
    {
        return Entry::with('category')
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->get()
            ->groupBy(fn($entry) => $entry->category?->name ?? 'Uncategorised')
            ->map(function ($items, $categoryName) {
                return [
                    'category' => $categoryName,
                    'total' => $items->sum('amount'),
                ];
            })
            ->sortByDesc('total')
            ->values();
    }

    public function dailyTotals(int $userId, int $year, int $month)
    {
        return Entry::where('user_id', $userId)
            ->where('type', 'expense')
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->selectRaw('transaction_date, SUM(amount) as total')
            ->groupBy('transaction_date')
            ->orderBy('transaction_date')
            ->get();
    }

    public function allTimeCategoryTotals(int $userId)
    {
        return Entry::with('category')
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->get()
            ->groupBy(fn($entry) => $entry->category?->name ?? 'Uncategorised')
            ->map(function ($items, $categoryName) {
                return [
                    'category' => $categoryName,
                    'total' => $items->sum('amount'),
                ];
            })
            ->sortByDesc('total')
            ->values();
    }

    public function exportEntries(int $userId, int $year, int $month): Collection
    {
        return Entry::with('category')
            ->where('user_id', $userId)
            ->where('type', 'expense')
            ->whereYear('transaction_date', $year)
            ->whereMonth('transaction_date', $month)
            ->get();
    }
}
