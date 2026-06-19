<?php

namespace App\Http\Controllers\Admin\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Dashboard\DashboardRepository;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __construct(
        private DashboardRepository $dashboardRepo
    ) {}

    public function index(): View
    {
        return view('admin.dashboard.index', array_merge(
            $this->dashboardRepo->stats(),
            [
                'recentUsers'   => $this->dashboardRepo->recentUsers(),
                'topCategories' => $this->dashboardRepo->topCategories(),
            ]
        ));
    }
}