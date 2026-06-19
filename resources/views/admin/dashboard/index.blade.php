<x-defaul-admin-layout :title="'Dashboard'">

    <div class="admin-page">

        <div class="admin-page__head">
            <p class="eyebrow">Control panel</p>
            <h1 class="admin-page__title">Dashboard</h1>
        </div>

        {{-- ── Stat cards ──────────────────────────────────────────────────── --}}
        <div class="admin-stats">

            <div class="admin-stat">
                <span class="admin-stat__icon">
                    <i class="fa-solid fa-user"></i>
                </span>
                <span class="admin-stat__value">{{ number_format($totalUsers) }}</span>
                <span class="admin-stat__label">Total users</span>
            </div>

            <div class="admin-stat">
                <span class="admin-stat__icon">
                    <i class="fa-solid fa-shield-halved"></i>
                </span>
                <span class="admin-stat__value">{{ number_format($totalAdmins) }}</span>
                <span class="admin-stat__label">Admins</span>
            </div>

            <div class="admin-stat">
                <span class="admin-stat__icon">
                    <i class="fa-solid fa-file-lines"></i>
                </span>
                <span class="admin-stat__value">{{ number_format($totalEntries) }}</span>
                <span class="admin-stat__label">Total entries</span>
            </div>

            <div class="admin-stat">
                <span class="admin-stat__icon">
                    <i class="fa-solid fa-tags"></i>
                </span>
                <span class="admin-stat__value">{{ number_format($totalCategories) }}</span>
                <span class="admin-stat__label">Categories</span>
            </div>

        </div>

        <div class="admin-cols">

            {{-- ── Recent users ─────────────────────────────────────────────── --}}
            <div class="admin-card">

                <div class="admin-card__head">
                    <h2 class="admin-card__title">Recent users</h2>
                    <a href="{{ route('admin.users.index') }}" class="admin-card__link">View all →</a>
                </div>

                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                                <th>Role</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($recentUsers as $user)
                                <tr>
                                    <td class="fw">{{ $user->name }}</td>
                                    <td class="muted">{{ $user->email }}</td>
                                    <td class="mono muted">{{ $user->created_at->format('M j, Y') }}</td>
                                    <td>
                                        @if ($user->is_admin)
                                            <span class="admin-badge admin-badge--gold">Admin</span>
                                        @else
                                            <span class="admin-badge">User</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>

            {{-- ── Top categories ───────────────────────────────────────────── --}}
            <div class="admin-card">

                <div class="admin-card__head">
                    <h2 class="admin-card__title">Top categories used</h2>
                    <a href="{{ route('admin.categories.index') }}" class="admin-card__link">Manage →</a>
                </div>

                <div class="admin-table-wrap">
                    <table class="admin-table">
                        <thead>
                            <tr>
                                <th>Category</th>
                                <th>Entries</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($topCategories as $cat)
                                <tr>
                                    <td class="fw">{{ $cat->category }}</td>
                                    <td class="mono">{{ number_format($cat->count) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="2" class="muted">No entries yet.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>

        </div>

    </div>

</x-defaul-admin-layout>
