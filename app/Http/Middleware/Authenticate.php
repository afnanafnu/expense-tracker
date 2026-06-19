<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {

            // ADMIN ROUTES
            if ($request->is('admin') || $request->is('admin/*')) {
                return route('admin.login');
            }

            // USER ROUTES
            return route('login');
        }
    }
}