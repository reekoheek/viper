(function(Mousetrap) {
    'use strict';

    Mousetrap.bind(['command+shift+f', 'ctrl+shift+f'], function(e) {
        $('.tt-input').focus();
        return false;
    });

    Mousetrap.bind(['command+alt+n', 'ctrl+alt+n'], function(e) {
        if (e.preventDefault) {
            e.preventDefault();
        } else {
            // internet explorer
            e.returnValue = false;
        }

        $.get(window.URL_SITE + '/entries/null/create').success(function() {
            window.location.href = window.URL_SITE + 'entries/null/create';
        }).fail(function() {
            window.location.href = window.URL_SITE + 'login';
        });
        return false;
    });

})(window.Mousetrap);
