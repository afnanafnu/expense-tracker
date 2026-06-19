@push('styles')
    @vite('resources/css/web/auth/auth.css')
@endpush

@push('scripts')
    @vite('resources/js/web/auth/register.js')
@endpush

<x-defaul-guest-layout :title="config('app.name', 'Hey Tally') . ' — Create your account'">

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

            <p class="auth__eyebrow">New account</p>

            <h1 class="auth__title">Open your ledger.</h1>

            <p class="auth__lead">Free to start, no card required. First entry takes under a minute.</p>

            @if ($errors->any())

                <div class="auth__alert auth__alert--error">

                    <ul>

                        @foreach ($errors->all() as $error)

                            <li>{{ $error }}</li>

                        @endforeach

                    </ul>

                </div>

            @endif

            <form method="POST" action="{{ route('register.submit') }}" id="registerForm" class="auth__form">

                @csrf

                <div class="auth__field">
                    <label for="name">Full name</label>
                    <input type="text"
                           id="name"
                           name="name"
                           value="{{ old('name') }}"
                           placeholder="Your name"
                           autofocus>
                </div>

                <div class="auth__field">
                    <label for="email">Email address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           placeholder="you@example.com">
                </div>

                <div class="auth__field">
                    <label for="password">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           placeholder="••••••••">
                </div>

                <div class="auth__field">
                    <label for="password_confirmation">Confirm password</label>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           placeholder="••••••••">
                </div>

                <p class="auth__terms">
                    By creating an account, you agree to the
                    <a href="#">Terms of Service</a> and <a href="#">Privacy Policy</a>.
                </p>

                <button type="submit" class="btn btn-primary btn-lg auth__submit">
                    Create free account
                </button>

            </form>

            <p class="auth__switch">
                Already have an account?
                <a href="{{ route('login') }}">Log in</a>
            </p>

        </div>

    </div>

</x-defaul-guest-layout>