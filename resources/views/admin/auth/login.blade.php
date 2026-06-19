@push('styles')
    @vite('resources/css/admin/auth/login.css')
@endpush

@push('scripts')
    @vite('resources/js/admin/auth/login.js')
@endpush

<x-defaul-guest-admin-layout :title="'Admin — ' . config('app.name', 'Tally')">

    <div class="admin-login">

        <div class="admin-login__card">

            {{-- Brand --}}
            <div class="admin-login__brand">

                <svg width="28" height="28" viewBox="0 0 26 26" fill="none">
                    <rect x="2" y="2" width="22" height="22" rx="4" stroke="#3fc9a4" stroke-width="1.6" />
                    <line x1="7" y1="9" x2="19" y2="9" stroke="#3fc9a4"
                        stroke-width="1.6" />
                    <line x1="7" y1="14" x2="16" y2="14" stroke="#3fc9a4"
                        stroke-width="1.6" opacity="0.6" />
                    <line x1="7" y1="19" x2="13" y2="19" stroke="#3fc9a4"
                        stroke-width="1.6" opacity="0.35" />
                </svg>

                <span class="admin-login__app-name">{{ config('app.name', 'Tally') }}</span>

                <span class="admin-login__badge">Admin</span>

            </div>

            {{-- Heading --}}
            <p class="admin-login__eyebrow">Restricted access</p>

            <h1 class="admin-login__title">Admin sign in</h1>

            <p class="admin-login__lead">
                This area is for administrators only. Regular user accounts will be denied entry.
            </p>

            {{-- Errors --}}
            @if ($errors->any())

                <div class="admin-login__alert">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="8" x2="12" y2="12" />
                        <line x1="12" y1="16" x2="12.01" y2="16" />
                    </svg>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>

            @endif

            {{-- Form --}}
            <form method="POST" action="{{ route('admin.login.submit') }}" class="auth__form" id="adminloginForm">

                @csrf

                <div class="auth__field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" name="email" placeholder="admin@example.com">
                    <small class="error-text" id="email-error"></small>
                </div>

                <div class="auth__field">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="••••••••">
                    <small class="error-text" id="password-error"></small>
                </div>

                <div class="admin-login__row">
                    <label class="auth__checkbox">
                        <input type="checkbox" name="remember">
                        <span>Remember me</span>
                    </label>
                </div>

                <button type="submit" class="btn btn-lg admin-login__submit">
                    Sign in to admin
                </button>

            </form>

            {{-- Back link --}}
            <p class="admin-login__back">
                <a href="{{ route('login') }}">← Back to user login</a>
            </p>

        </div>

    </div>

</x-defaul-guest-admin-layout>
