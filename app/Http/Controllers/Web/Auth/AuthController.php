<?php

namespace App\Http\Controllers\Web\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Web\Auth\LoginRequest;
use App\Http\Requests\Web\Auth\RegisterRequest;
use App\Repositories\Web\Auth\AuthRepositoryInterface;

class AuthController extends Controller
{
    protected AuthRepositoryInterface $authRepo;

    public function __construct(AuthRepositoryInterface $authRepo)
    {
        $this->authRepo = $authRepo;
    }

    public function showLoginForm()
    {
        return view('web.auth.login');
    }

    public function showRegisterForm()
    {
        return view('web.auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authRepo->register($request->validated());

        Auth::login($user); // skiping login user

        $request->session()->regenerate();

        return redirect()->route('dashboard')
            ->with('success', 'Welcome! Registration successful.');
    }

    public function login(LoginRequest $request)
    {
        $success = $this->authRepo->login($request->validated());

        if (! $success) {
            return back()->withErrors([
                'email' => 'Invalid credentials.',
            ])->withInput();
        }

        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        $this->authRepo->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }
}
