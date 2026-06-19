@push('styles')
    @vite('resources/css/web/reports/reports.css')
@endpush

@push('scripts')
    @vite('resources/js/web/reports/reports.js')
@endpush

<x-defaul-guest-layout :title="config('app.name', 'Hey Tally') . ' — Reports'">

    <div class="wrap reports">

        {{-- HEADER --}}
        <div class="reports__head">

            <div>
                <p class="eyebrow">Insights</p>
                <h1 class="reports__title">Reports</h1>
            </div>

            <a href="{{ route('dashboard') }}" class="btn btn-ghost">← Dashboard</a>

        </div>

        {{-- FILTER --}}
        <div class="filter-bar">

            <div class="filter-bar__left">

                <div class="filter-bar__field">
                    <label>Month</label>
                    <select id="month">
                        @foreach (range(1, 12) as $m)
                            <option value="{{ $m }}" {{ $m == now()->month ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->format('F') }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-bar__field">
                    <label>Year</label>
                    <select id="year">
                        @foreach (range(now()->year, now()->year - 4) as $y)
                            <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>
                                {{ $y }}
                            </option>
                        @endforeach
                    </select>
                </div>

            </div>

            <div class="filter-bar__right">

                <a href="#" id="exportExcel" class="btn btn-ghost">
                    ⬇ Excel
                </a>

                <a href="#" id="exportPdf" class="btn btn-ghost">
                    ⬇ PDF
                </a>

            </div>

        </div>

        {{-- TABS --}}
        <div class="report-tabs">

            <button class="report-tab is-active" data-tab="categories">
                <i class="fa-solid fa-chart-pie"></i>
                Monthly by category
            </button>

            <button class="report-tab" data-tab="daily">
                <i class="fa-solid fa-chart-line"></i>
                Daily average
            </button>

            <button class="report-tab" data-tab="alltime">
                <i class="fa-solid fa-chart-bar"></i>
                All-time
            </button>

        </div>

        {{-- PANELS --}}
        <div class="report-panel is-active" id="tab-categories">
            <div id="monthly-category-content">Loading...</div>
        </div>

        <div class="report-panel" id="tab-daily">
            <div id="daily-content">Loading...</div>
        </div>

        <div class="report-panel" id="tab-alltime">
            <div id="alltime-content">Loading...</div>
        </div>

    </div>

</x-defaul-guest-layout>
