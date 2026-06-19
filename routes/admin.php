<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\User\UserController;
use App\Http\Controllers\Admin\Category\CategoryController;

/*
|--------------------------------------------------------------------------
| Admin Guest Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware('guest')
    ->group(function () {

        Route::controller(AuthController::class)->group(function () {

            Route::get('/login', 'showLoginForm')
                ->name('login');

            Route::post('/login', 'login')
                ->name('login.submit');
        });
    });

/*
|--------------------------------------------------------------------------
| Admin Protected Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/', [DashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Logout
        |--------------------------------------------------------------------------
        */

        Route::post('/logout', [AuthController::class, 'logout'])
            ->name('logout');

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

        Route::prefix('users')
            ->name('users.')
            ->controller(UserController::class)
            ->group(function () {

                Route::get('/', 'index')
                    ->name('index');

                Route::get('/data', 'data')
                    ->name('data');

                Route::put('/{user}', 'update')
                    ->name('update');

                Route::delete('/{user}', 'destroy')
                    ->name('destroy');

                Route::patch('/{user}/toggle-admin', 'toggleAdmin')
                    ->name('toggle-admin');
            });

        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::prefix('categories')
            ->name('categories.')
            ->controller(CategoryController::class)
            ->group(function () {

                Route::get('/', 'index')
                    ->name('index');

                Route::get('/data', 'data')
                    ->name('data');

                Route::post('/', 'store')
                    ->name('store');

                Route::put('/{category}', 'update')
                    ->name('update');

                Route::delete('/{category}', 'destroy')
                    ->name('destroy');
            });
    });