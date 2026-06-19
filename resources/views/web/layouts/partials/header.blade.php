<div class="wrap">

    <nav class="nav">

        <a href="{{ route('home') }}" class="nav__brand">

            <svg width="26" height="26" viewBox="0 0 26 26" fill="none">
                <rect x="2" y="2" width="22" height="22" rx="4" stroke="#3fc9a4" stroke-width="1.6" />
                <line x1="7" y1="9" x2="19" y2="9" stroke="#3fc9a4" stroke-width="1.6" />
                <line x1="7" y1="14" x2="16" y2="14" stroke="#3fc9a4" stroke-width="1.6"
                    opacity="0.6" />
                <line x1="7" y1="19" x2="13" y2="19" stroke="#3fc9a4" stroke-width="1.6"
                    opacity="0.35" />
            </svg>

            <span class="brand-name">{{ config('app.name', 'Tally') }}</span>

        </a>

        <div class="nav__actions">

            @auth
                <span class="nav__user">
                    Hi, {{ auth()->user()->name }}
                </span>

                @if (request()->routeIs('reports.*'))
                    <a href="{{ route('dashboard') }}" class="btn btn-ghost">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('reports.index') }}" class="btn btn-ghost">
                        Reports
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-ghost">
                        Log out
                    </button>
                </form>
            @endauth

        </div>

    </nav>

</div>
