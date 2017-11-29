jQuery(function ($) {
    "use strict";
    var $wrapper = $('.tggatos-status-wrapper').eq(0);
    var ajaxUrl = $wrapper.data('ajax-url');
    var pollerTimeoutHandle = null;

    function processPollResult(data) {
        if (data.result) {
            $wrapper.removeClass('tggatos-status-awaiting');
            scheduleRedirection(data.url);
        } else {
            scheduleNextPoll();
        }
    }

    function poll() {
        $.post(ajaxUrl, {action: 'process-response'}, processPollResult, 'json')
            .fail(scheduleNextPoll)
        ;
    }

    function scheduleNextPoll() {
        pollerTimeoutHandle = setTimeout(poll, 3000);
    }

    function scheduleRedirection(url) {
        setTimeout(function () {
            window.location = url;
        }, 3000);
    }

    poll();

});
