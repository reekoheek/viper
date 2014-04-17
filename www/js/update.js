(function ($, ace, marked, hljs) {
    'use strict';

    $('body').loadie();

    var editor = ace.edit($('.le-editor')[0]);

    editor.setTheme('ace/theme/github');
    editor.session.setMode('ace/mode/markdown');

    editor.focus();
    editor.gotoLine(editor.session.getLength(), editor.session.getLine(editor.session.getLength() - 1).length);

    $('body').loadie(0.5);

    marked.setOptions({
        highlight: function (code) {
            return hljs.highlightAuto(code).value;
        }
    });

    if ($('.le-preview').html().length === 0) {
        $('.le-preview').html(marked(editor.getValue()));
        $('body').loadie(1);
    }

    editor.on('change', function (event) {
        $('.le-preview').html(marked(editor.getValue()));
        $('.le-preview').scrollTop($('.le-preview')[0].scrollHeight);
    });

    editor.on('blur', function (event) {
        if (($('.le-preview').html().length > 0) === false) {
            $('.le-preview').html('<h1 class="le-holder">PREVIEW</h1>');
        }
    });

    $('.le-action .save').on('click', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $('body').loadie();

        $('[name=content]').val(editor.getValue());

        var data = $('form').serialize();

        $.ajax({
            url: location.href + '.json',
            data: data,
            type: 'POST'
        }).done(function (data, textStatus, jqXHR) {
            $('body').loadie(1);
            $('.alert').attr('class', 'alert success');
            $('body .le-content div .alert span').text('Success updating!');
            $('body .le-content div .alert').fadeIn();
            window.console.log(data, textStatus, jqXHR);
        }).fail(function (data, textStatus, jqXHR) {
            $('body').loadie(1);
            $('.alert').attr('class', 'alert error');
            $('body .le-content div .alert span').text('Error updating!');
            $('body .le-content div .alert').fadeIn();
            window.console.error(data, textStatus, jqXHR);
        });
    });
})(window.$, window.ace, window.marked, window.hljs);
