@push('styles')
    @vite('resources/css/web/auth/auth.css')
@endpush

@push('scripts')
    @vite('resources/js/web/auth/login.js')
@endpush

<x-defaul-guest-layout :title="config('app.name', 'Hey Tally') . ' — Log in'">

    <div class="auth">

        <div class="auth__card">

            <a href="{{ url('/') }}" class="auth__brand">

                <svg width="22" height="22" viewBox="0 0 26 26" fill="none">
                    <rect x="2" y="2" width="22" height="22" rx="4" stroke="#2a9d80" stroke-width="1.6"/>
                    <line x1="7" y1="9" x2="19" y2="9" stroke="#2a9d80" stroke-width="1.6"/>
                    <line x1="7" y1="14" x2="16" y2="14" stroke="#2a9d80" stroke-width="1.6" opacity="0.6"/>
                    <line x1="7" y1="19" x2="13" y2="19" stroke="#2a9d80" stroke-width="1.6" opacity="0.35"/>
                </svg>

                <span>{{ config('app.name', 'Tally') }}</span>

            </a>

            <p class="auth__eyebrow">Account access</p>

            <h1 class="auth__title">Welcome back.</h1>

            <p class="auth__lead">Log in to see exactly where this month's money went.</p>

            @if (session('success'))

                <div class="auth__alert auth__alert--success">
                    {{ session('success') }}
                </div>

            @endif

            @if ($errors->any())

                <div class="auth__alert auth__alert--error">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="POST" action="{{ route('login.submit') }}"  id="loginForm" class="auth__form">

                @csrf

                <div class="auth__field">
                    <label for="email">Email address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com"
                           autofocus>
                </div>

                <div class="auth__field">
                    <label for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="••••••••">
                </div>

                <div class="auth__row">

                    <label class="auth__checkbox">
                        <input type="checkbox" name="remember" id="remember">
                        <span>Remember me</span>
                    </label>

                    <a href="#" class="auth__link">Forgot password?</a>

                </div>

                <button type="submit" class="btn btn-primary btn-lg auth__submit">
                    Log in
                </button>

            </form>

            <p class="auth__switch">
                Don't have an account?
                <a href="{{ route('register') }}">Create one</a>
            </p>

        </div>

    </div>

</x-defaul-guest-layout>