@push('styles')
    @vite('resources/css/admin/category/category.css')
@endpush

@push('scripts')
    @vite('resources/js/admin/category/category.js')
@endpush

<x-defaul-admin-layout :title="'Categories'">

    <div class="admin-page">

        <div class="admin-page__head">
            <div>
                <p class="eyebrow">Manage</p>
                <h1 class="admin-page__title">Categories</h1>
            </div>

            <button id="addCategory"
                type="button"
                class="btn btn--primary"
                data-add-category>
                Add Category
            </button>
        </div>

        @if (session('success'))
            <div class="admin-alert admin-alert--success">
                {{ session('success') }}
            </div>
        @endif

        <div class="admin-card">

            <div class="admin-table-wrap">

                <table class="admin-table" id="categoriesTable">

                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

    @include('admin.categories.partials.add-modal')
    @include('admin.categories.partials.edit-modal')

</x-defaul-admin-layout>