@push('styles')
    @vite('resources/css/web/dashboard/dashboard.css')
@endpush

@push('scripts')
    @vite('resources/js/web/dashboard/dashboard.js')
@endpush

<x-defaul-guest-layout :title="config('app.name', 'Tally') . ' — Dashboard'">

    <div class="wrap dashboard">

        <div class="dashboard__head">

            <div>
                <p class="eyebrow">Your ledger</p>
                <h1 class="dashboard__title">All entries</h1>
            </div>

            <button type="button" class="btn btn-primary" data-modal-open data-mode="create">
                + Add entry
            </button>

        </div>

        {{-- Toast Messages --}}
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.showToast('success', @json(session('success')));
                });
            </script>
        @endif

        @if (session('error'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    window.showToast('error', @json(session('error')));
                });
            </script>
        @endif

        {{-- Summary Cards --}}
        <div class="summary-cards">

            <div class="summary-card">
                <span class="summary-card__label">Money in</span>
                <span class="summary-card__amount amount--in">
                    +₹{{ number_format($totalIncome, 2) }}
                </span>
            </div>

            <div class="summary-card">
                <span class="summary-card__label">Money out</span>
                <span class="summary-card__amount amount--out">
                    −₹{{ number_format($totalExpense, 2) }}
                </span>
            </div>

            <div class="summary-card summary-card--balance">
                <span class="summary-card__label">Balance</span>
                <span class="summary-card__amount">
                    {{ $balance >= 0 ? '+' : '−' }}₹{{ number_format(abs($balance), 2) }}
                </span>
            </div>

        </div>

        {{-- Ledger List --}}
        <div class="ledger-list">

            @forelse ($entries as $entry)
                <div class="ledger-row">

                    <div class="ledger-row__label">
                        <span class="ledger-row__name">{{ $entry->title }}</span>

                        <small>
                            {{ $entry->transaction_date?->format('M j') ?? '-' }}

                            @if ($entry->category)
                                · {{ $entry->category->name }}
                            @endif
                        </small>
                    </div>

                    <span class="ledger-row__amount {{ $entry->isIncome() ? 'amount--in' : 'amount--out' }}">
                        {{ $entry->isIncome() ? '+' : '−' }}₹{{ number_format($entry->amount, 2) }}
                    </span>

                    <div class="ledger-row__actions">

                        <button type="button" class="icon-btn" data-modal-open data-mode="edit"
                            data-action="{{ route('entries.update', $entry) }}?page={{ request('page', 1) }}"
                            data-title="{{ $entry->title }}"
                            data-category="{{ $entry->category?->id }}" data-type="{{ $entry->type }}"
                            data-amount="{{ $entry->amount }}"
                            data-date="{{ $entry->transaction_date?->format('Y-m-d') }}"
                            data-description="{{ $entry->description }}">
                            Edit
                        </button>

                        <form method="POST" action="{{ route('entries.destroy', $entry) }}?page={{ request('page', 1) }}"
                            class="ledger-row__delete-form">
                            @csrf
                            @method('DELETE')

                            <button type="submit" class="icon-btn icon-btn--danger" data-confirm-delete>
                                Delete
                            </button>
                        </form>

                    </div>

                </div>
            @empty
                <div class="ledger-empty">
                    <p class="ledger-empty__title">No entries yet.</p>
                    <p class="ledger-empty__hint">
                        Add your first one to start tracking where the money goes.
                    </p>
                </div>
            @endforelse

        </div>

        {{-- Pagination (IMPORTANT FIX) --}}
        @if ($entries->hasPages())
            <div class="ledger-pagination">
                {{ $entries->links() }}
            </div>
        @endif

    </div>

    {{-- Add / edit modal --}}
    <div class="modal" id="entry-modal" data-modal>

        <div class="modal__panel">

            <div class="modal__head">
                <h2 class="modal__title" data-modal-title>Add entry</h2>
                <button type="button" class="modal__close" data-modal-close aria-label="Close">&times;</button>
            </div>

            <form method="POST" action="{{ route('entries.store') }}" class="auth__form" id="entry-form"
                data-store-url="{{ route('entries.store') }}">

                @csrf
                <input type="hidden" name="_method" id="entry-form-method" value="POST">

                <div class="auth__field">
                    <label for="title">What was it for?</label>
                    <input type="text" id="title" name="title"
                        placeholder="Rent, groceries, freelance payment…">
                </div>

                <div class="entry-form__type">

                    <label class="auth__checkbox">
                        <input type="radio" name="type" value="expense" checked>
                        <span>Money out</span>
                    </label>

                    <label class="auth__checkbox">
                        <input type="radio" name="type" value="income">
                        <span>Money in</span>
                    </label>

                </div>

                <div class="auth__field">
                    <label for="amount">Amount (₹)</label>
                    <input type="number" id="amount" name="amount" step="0.01" min="0.01"
                        placeholder="0.00">
                </div>

                <div class="auth__field">
                    <label for="category">Category</label>

                    <select id="category" name="category_id" class="select2-category" style="width:100%">
                        <option value="">Select Category</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>
                </div>

                <div class="auth__field">
                    <label for="transaction_date">Date</label>
                    <input type="date" id="transaction_date" name="transaction_date">
                </div>

                <div class="auth__field">
                    <label for="description">Description</label>
                    <input type="text" id="description" name="description" placeholder="Optional">
                </div>

                <button type="submit" class="btn btn-primary btn-lg auth__submit">Save entry</button>

            </form>

        </div>

    </div>

</x-defaul-guest-layout>
