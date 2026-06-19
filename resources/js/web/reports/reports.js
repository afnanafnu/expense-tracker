$(function () {

    const $tabs = $('.report-tab');
    const $panels = $('.report-panel');

    const $month = $('#month');
    const $year = $('#year');
    const $applyBtn = $('#applyFilter');

    let cache = {
        categories: null,
        daily: null,
        alltime: null
    };

    // ─────────────────────────────────────────────
    // TAB SWITCH
    // ─────────────────────────────────────────────
    function switchTab(tab) {

        $tabs.removeClass('is-active');
        $tabs.filter(`[data-tab="${tab}"]`).addClass('is-active');

        $panels.removeClass('is-active');
        $(`#tab-${tab}`).addClass('is-active');

        // ── LOAD DATA BASED ON TAB ──
        if (tab === 'categories') {
            loadMonthly();
            animateBars($('#tab-categories'));
        }

        if (tab === 'daily') {
            loadDaily();
            animateBars($('#tab-daily'));
        }

        if (tab === 'alltime') {
            loadAllTime();
            animateBars($('#tab-alltime'));
        }
    }

    $tabs.on('click', function () {
        switchTab($(this).data('tab'));
    });

    // ─────────────────────────────────────────────
    // PROGRESS BAR ANIMATION
    // ─────────────────────────────────────────────
    function animateBars($panel) {

        $panel.find('.progress-fill').each(function () {

            const $bar = $(this);
            const targetWidth = $bar.data('width') || $bar[0].style.width;

            $bar.stop(true, true)
                .css('width', '0%')
                .animate({ width: targetWidth }, 500);
        });
    }

    // ─────────────────────────────────────────────
    // BUILD PARAMS
    // ─────────────────────────────────────────────
    function getParams() {
        return {
            month: $month.val(),
            year: $year.val()
        };
    }

    // ─────────────────────────────────────────────
    // LOAD MONTHLY CATEGORY
    // ─────────────────────────────────────────────
    function loadMonthly() {

        if (cache.categories) {
            renderMonthly(cache.categories);
            return;
        }

        $.get('/reports/monthly-category', getParams(), function (res) {

            cache.categories = res;
            renderMonthly(res);
        });
    }

    function renderMonthly(res) {

        let html = `<h2>Total: ₹${parseFloat(res.total).toFixed(2)}</h2>`;

        res.data.forEach(row => {

            const pct = res.total > 0 ? (row.total / res.total) * 100 : 0;

            html += `
                <div class="category-row">
                    <div class="category-row__meta">
                        <span class="category-row__name">${row.category}</span>
                        <span class="category-row__pct">${pct.toFixed(1)}%</span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill" data-width="${pct}%"></div>
                    </div>

                    <span class="category-row__amount amount--out">
                        −₹${parseFloat(row.total).toFixed(2)}
                    </span>
                </div>
            `;
        });

        $('#monthly-category-content').html(html);

        animateBars($('#tab-categories'));
    }

    // ─────────────────────────────────────────────
    // LOAD DAILY
    // ─────────────────────────────────────────────
    function loadDaily() {

        if (cache.daily) {
            renderDaily(cache.daily);
            return;
        }

        $.get('/reports/average-daily', getParams(), function (res) {

            cache.daily = res;
            renderDaily(res);
        });
    }

    function renderDaily(res) {

        let html = `
            <h2>Avg: ₹${parseFloat(res.avg).toFixed(2)}</h2>
            <h3>Max: ₹${parseFloat(res.max).toFixed(2)}</h3>
        `;

        $('#daily-content').html(html);
    }

    // ─────────────────────────────────────────────
    // LOAD ALL TIME
    // ─────────────────────────────────────────────
    function loadAllTime() {

        if (cache.alltime) {
            renderAllTime(cache.alltime);
            return;
        }

        $.get('/reports/user-category', function (res) {

            cache.alltime = res;
            renderAllTime(res);
        });
    }

    function renderAllTime(res) {

        let html = `<h2>Total: ₹${parseFloat(res.total).toFixed(2)}</h2>`;

        res.data.forEach(row => {

            const pct = res.total > 0 ? (row.total / res.total) * 100 : 0;

            html += `
                <div class="category-row">
                    <div class="category-row__meta">
                        <span class="category-row__name">${row.category}</span>
                        <span class="category-row__pct">${pct.toFixed(1)}%</span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill" data-width="${pct}%"></div>
                    </div>

                    <span class="category-row__amount amount--out">
                        −₹${parseFloat(row.total).toFixed(2)}
                    </span>
                </div>
            `;
        });

        $('#alltime-content').html(html);

        animateBars($('#tab-alltime'));
    }

    // ─────────────────────────────────────────────
    // APPLY FILTER (reload all tabs)
    // ─────────────────────────────────────────────
    function reloadAll() {
        cache = { categories: null, daily: null, alltime: null };

        loadMonthly();
        loadDaily();
        loadAllTime();
    }

    $applyBtn.on('click', function () {
        reloadAll();
    });

    $month.on('change', reloadAll);
    $year.on('change', reloadAll);

    // ─────────────────────────────────────────────
    // INITIAL LOAD
    // ─────────────────────────────────────────────
    loadMonthly();

    function updateExportLinks() {

        const month = $('#month').val();
        const year = $('#year').val();

        $('#exportExcel').attr(
            'href',
            `/reports/export/excel?month=${month}&year=${year}`
        );

        $('#exportPdf').attr(
            'href',
            `/reports/export/pdf?month=${month}&year=${year}`
        );
    }

    // update on load
    updateExportLinks();

    // update on change
    $('#month, #year').on('change', function () {
        updateExportLinks();
    });

    $('#month, #year').on('change', function () {
        $('#exportExcel, #exportPdf').addClass('loading');
        updateExportLinks();
    });

});