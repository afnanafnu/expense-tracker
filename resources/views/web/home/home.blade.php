@push('styles')
    @vite('resources/css/web/home/welcome.css')
@endpush

@push('scripts')
    @vite('resources/js/web/home/home.js')
@endpush

<x-defaul-guest-layout :title="config('app.name', 'Tally') . ' — Know where every rupee goes'">

    <div class="wrap">

        <section class="hero">

            <div>

                <p class="eyebrow">Personal finance, kept honest</p>

                <h1>Know where <em>every rupee</em> goes.</h1>

                <p class="lead">
                    {{ config('app.name', 'Tally') }} logs every expense the moment it happens, sorts it
                    into categories on its own, and shows you exactly where your money went this month —
                    no spreadsheets, no end-of-month guesswork.
                </p>

                @if (Route::has('register'))

                    <div class="hero__ctas">

                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create free account</a>

                        @if (Route::has('login'))
                            <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">Log in</a>
                        @endif

                    </div>

                @endif

                <p class="hero__trust">Free to start. No card required.</p>

            </div>

            <div class="ledger">

                <div class="ledger__head">
                    <h3>This month</h3>
                    <span>JUNE 2026</span>
                </div>

                <div class="entry-row" style="--i:0">
                    <div class="entry-row__label">Rent<small>Jun 1</small></div>
                    <div class="entry-row__amount amount--out">−₹15,000</div>
                </div>

                <div class="entry-row" style="--i:1">
                    <div class="entry-row__label">Freelance payment<small>Jun 10</small></div>
                    <div class="entry-row__amount amount--in">+₹8,500</div>
                </div>

                <div class="entry-row" style="--i:2">
                    <div class="entry-row__label">Groceries<small>Jun 14</small></div>
                    <div class="entry-row__amount amount--out">−₹1,240</div>
                </div>

                <div class="entry-row" style="--i:3">
                    <div class="entry-row__label">Electricity<small>Jun 5</small></div>
                    <div class="entry-row__amount amount--out">−₹860</div>
                </div>

                <div class="ledger__total">
                    <span>Net this month</span>
                    <span class="amount">+₹<span id="balance-amount" data-target="4920">0</span></span>
                </div>

            </div>

        </section>

        <section class="features">

            <div class="features__head">
                <h2>Four entries that explain the whole app.</h2>
                <p>Everything below is what actually happens after you sign up — no filler features.</p>
            </div>

            <div class="feature-row">
                <span class="feature-row__num">01</span>
                <div>
                    <h3 class="feature-row__title">Add an expense in seconds</h3>
                    <p class="feature-row__desc">Type an amount and a note. Category suggestions show up as you type,
                        based on what you've logged before.</p>
                </div>
                <span class="feature-row__tag">Fast</span>
            </div>

            <div class="feature-row">
                <span class="feature-row__num">02</span>
                <div>
                    <h3 class="feature-row__title">Recurring costs sort themselves</h3>
                    <p class="feature-row__desc">Rent, subscriptions, and bills are recognized automatically once you've
                        logged them a couple of times.</p>
                </div>
                <span class="feature-row__tag">Automatic</span>
            </div>

            <div class="feature-row">
                <span class="feature-row__num">03</span>
                <div>
                    <h3 class="feature-row__title">A monthly picture, not a wall of rows</h3>
                    <p class="feature-row__desc">See spend by category and trend over time, so the question "where did
                        it all go" has an actual answer.</p>
                </div>
                <span class="feature-row__tag">Clear</span>
            </div>

            <div class="feature-row">
                <span class="feature-row__num">04</span>
                <div>
                    <h3 class="feature-row__title">Your data stays yours</h3>
                    <p class="feature-row__desc">Export everything as a spreadsheet whenever you want, or delete your
                        account and data in one step.</p>
                </div>
                <span class="feature-row__tag">Private</span>
            </div>

        </section>

        @if (Route::has('register'))

            <section class="cta-band">

                <h2>Start your first entry today.</h2>

                <p>It takes less time than finding last month's receipts.</p>

                <div class="hero__ctas">

                    <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Create free account</a>

                    @if (Route::has('login'))
                        <a href="{{ route('login') }}" class="btn btn-ghost btn-lg">I already have an account</a>
                    @endif

                </div>

            </section>

        @endif

    </div>

</x-defaul-guest-layout>
