<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

/* ---------- Web ---------- */
use App\Repositories\Web\Entry\EntryRepository;
use App\Repositories\Web\Entry\EntryRepositoryInterface;

use App\Repositories\Web\Auth\AuthRepository;
use App\Repositories\Web\Auth\AuthRepositoryInterface;

use App\Repositories\Web\Report\ReportRepository;
use App\Repositories\Web\Report\ReportRepositoryInterface;

/* ---------- Admin ---------- */
use App\Repositories\Admin\Dashboard\DashboardRepository;
use App\Repositories\Admin\Dashboard\DashboardRepositoryInterface;

use App\Repositories\Admin\User\UserRepository;
use App\Repositories\Admin\User\UserRepositoryInterface;

use App\Repositories\Admin\Category\CategoryRepository;
use App\Repositories\Admin\Category\CategoryRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Web bindings
        $this->app->bind(EntryRepositoryInterface::class, EntryRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, AuthRepository::class);
        $this->app->bind(ReportRepositoryInterface::class, ReportRepository::class);

        // Admin bindings
        $this->app->bind(
            DashboardRepositoryInterface::class,
            DashboardRepository::class
        );
        $this->app->bind(
           UserRepositoryInterface::class,
           UserRepository::class
        );
        $this->app->bind(
           CategoryRepositoryInterface::class,
           CategoryRepository::class
        );
    }

    public function boot(): void
    {
        Paginator::defaultView('pagination::simple-default');
    }
}