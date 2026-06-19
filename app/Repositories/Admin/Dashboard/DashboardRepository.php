<?php

namespace App\Repositories\Admin\Dashboard;

use App\Models\User;
use App\Models\Entry;
use App\Models\Category;

class DashboardRepository
{
    public function stats(): array
    {
        return [
            'totalUsers'      => User::where('role', '!=', 'admin')->count(),
            'totalAdmins'     => User::where('role', 'admin')->count(),
            'totalEntries'    => Entry::count(),
            'totalCategories' => Category::count(),
        ];
    }
    public function recentUsers()
    {
        return User::where('role', '!=', 'admin')
            ->latest()
            ->take(5)
            ->get();
    }

    public function topCategories()
    {
        return \App\Models\Entry::selectRaw('
            COALESCE(categories.name, "Uncategorised") as category,
            COUNT(entries.id) as count
        ')
            ->leftJoin('categories', 'entries.category_id', '=', 'categories.id')
            ->groupBy('categories.name')
            ->orderByDesc('count')
            ->take(5)
            ->get();
    }
}
