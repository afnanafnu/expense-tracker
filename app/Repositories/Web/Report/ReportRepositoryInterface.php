<?php

namespace App\Repositories\Web\Report;
use Illuminate\Support\Collection;

interface ReportRepositoryInterface
{
    public function expensesByCategory(int $userId, int $year, int $month);
    public function dailyTotals(int $userId, int $year, int $month);
    public function allTimeCategoryTotals(int $userId);
    public function exportEntries(int $userId, int $year, int $month): Collection;
}