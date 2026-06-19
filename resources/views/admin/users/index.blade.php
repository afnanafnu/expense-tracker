@push('styles')
    @vite('resources/css/admin/user/user.css')
@endpush

@push('scripts')
    @vite('resources/js/admin/user/user.js')
@endpush

<x-defaul-admin-layout :title="'Users'">

    <div class="admin-page">

        <div class="admin-page__head">
            <div>
                <p class="eyebrow">Manage</p>
                <h1 class="admin-page__title">Users</h1>
            </div>
        </div>

        @if (session('success'))
            <div class="admin-alert admin-alert--success">{{ session('success') }}</div>
        @endif

        {{-- DataTable renders its length/search controls here automatically --}}
        <div class="admin-card">
            <div class="admin-table-wrap">
                <table class="admin-table" id="usersTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Entries</th>
                            <th>Joined</th>
                            <th>Role</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>

    </div>

    @include('admin.users.partials.edit-modal')

</x-defaul-admin-layout>
