(function ($) {
    'use strict';

    $(document).ready(function () {
        $('.alert .close').click(function () {
            $('.alert').fadeOut();
        });

        $(document).on('click', 'a.button.twitter', function(event) {
            event.preventDefault();
            event.stopImmediatePropagation();

            var width  = 575,
                height = 400,
                left   = ($(window).width()  - width)  / 2,
                top    = ($(window).height() - height) / 2,
                url    = this.href,
                opts   = 'status=1' +
                         ',width='  + width  +
                         ',height=' + height +
                         ',top='    + top    +
                         ',left='   + left;

            window.open(url, 'twitter', opts);

            return false;
        });
    });
})(window.$);
