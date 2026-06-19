<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Entry\EntryController;
use App\Http\Controllers\Web\Report\ReportController;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    if (auth()->check()) {

        return auth()->user()->role === 'admin'
            ? redirect()->route('admin.dashboard')
            : redirect()->route('dashboard');
    }

    return view('web.home.home');

})->name('home');

/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::controller(AuthController::class)->group(function () {

        Route::get('/login', 'showLoginForm')
            ->name('login');

        Route::post('/login', 'login')
            ->name('login.submit');

        Route::get('/register', 'showRegisterForm')
            ->name('register');

        Route::post('/register', 'register')
            ->name('register.submit');
    });
});

/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| User Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'user'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Dashboard / Entries
    |--------------------------------------------------------------------------
    */

    Route::controller(EntryController::class)->group(function () {

        Route::get('/dashboard', 'index')
            ->name('dashboard');

        Route::post('/entries', 'store')
            ->name('entries.store');

        Route::put('/entries/{entry}', 'update')
            ->name('entries.update');

        Route::delete('/entries/{entry}', 'destroy')
            ->name('entries.destroy');
    });

    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::prefix('reports')
        ->name('reports.')
        ->controller(ReportController::class)
        ->group(function () {

            Route::get('/', 'index')
                ->name('index');

            Route::get('/monthly-category', 'monthlyCategory')
                ->name('monthly_category');

            Route::get('/average-daily', 'averageDaily')
                ->name('average_daily');

            Route::get('/user-category', 'userCategory')
                ->name('user_category');

            Route::get('/export/excel', 'exportExcel')
                ->name('export.excel');

            Route::get('/export/pdf', 'exportPdf')
                ->name('export.pdf');
        });
});