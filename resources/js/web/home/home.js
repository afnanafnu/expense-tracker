$(function () {
    var $el = $('#balance-amount');
    if (!$el.length) return;

    var target = parseInt($el.attr('data-target'), 10) || 0;
    var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    if (reduceMotion) {
        $el.text(target.toLocaleString('en-IN'));
        return;
    }

    var duration = 1100;
    var start = null;

    function step(timestamp) {
        if (!start) start = timestamp;
        var progress = Math.min((timestamp - start) / duration, 1);
        var eased = 1 - Math.pow(1 - progress, 3);
        var current = Math.floor(eased * target);
        $el.text(current.toLocaleString('en-IN'));
        if (progress < 1) requestAnimationFrame(step);
    }

    requestAnimationFrame(step);
});