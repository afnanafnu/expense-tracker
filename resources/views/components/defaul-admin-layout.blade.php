<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin · {{ $title ?? config('app.name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    @vite('resources/css/admin/default/app.css')
    @vite('resources/css/admin/partials/header.css')
    @vite('resources/css/admin/partials/footer.css')
    @vite('resources/css/admin/partials/sidebar.css')
    @vite('resources/js/admin/default/app.js')

    @stack('styles')
</head>
<body class="admin-body">

    <div class="admin-shell">

        {{-- ── Sidebar ────────────────────────────────────────────────────── --}}
        <aside class="sidebar">

            <a href="{{ route('admin.dashboard') }}" class="sidebar__brand">
                <svg width="22" height="22" viewBox="0 0 26 26" fill="none">
                    <rect x="2" y="2" width="22" height="22" rx="4" stroke="#3fc9a4" stroke-width="1.6"/>
                    <line x1="7" y1="9" x2="19" y2="9" stroke="#3fc9a4" stroke-width="1.6"/>
                    <line x1="7" y1="14" x2="16" y2="14" stroke="#3fc9a4" stroke-width="1.6" opacity="0.6"/>
                    <line x1="7" y1="19" x2="13" y2="19" stroke="#3fc9a4" stroke-width="1.6" opacity="0.35"/>
                </svg>
                <span>{{ config('app.name', 'Tally') }}</span>
                <span class="sidebar__badge">Admin</span>
            </a>

            <nav class="sidebar__nav">

                <span class="sidebar__section-label">Overview</span>

                <a href="{{ route('admin.dashboard') }}"
                   class="sidebar__link {{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                        <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                    </svg>
                    Dashboard
                </a>

                <span class="sidebar__section-label">Manage</span>

                <a href="{{ route('admin.users.index') }}"
                   class="sidebar__link {{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                    </svg>
                    Users
                </a>

                <a href="{{ route('admin.categories.index') }}"
                   class="sidebar__link {{ request()->routeIs('admin.categories.*') ? 'is-active' : '' }}">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 7h4l2-4h6l2 4h4"/><rect x="3" y="7" width="18" height="13" rx="2"/>
                    </svg>
                    Categories
                </a>

            </nav>

            <div class="sidebar__footer">

                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button type="submit" class="sidebar__link sidebar__link--btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                        Log out
                    </button>
                </form>
            </div>

        </aside>

        {{-- ── Main ───────────────────────────────────────────────────────── --}}
        <main class="admin-main">
            {{ $slot }}
        </main>

    </div>

    @stack('scripts')

</body>
</html>