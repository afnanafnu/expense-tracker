<?php

namespace App\Repositories\Admin\Dashboard;

interface DashboardRepositoryInterface
{
    public function stats(): array;
    public function recentUsers();
    public function topCategories();
}