(function ($, ace, marked, hljs, Bloodhound) {
    'use strict';

    $('body').loadie();

    $(document).on('click', '.tabs .nav', function(event) {
        event.preventDefault();

        var target = $(event.target),
            contentId = target.attr('href');

        $('.tabs section .content').removeClass('active');
        $('.tabs a.nav').removeClass('active');

        target.addClass('active');
        $(contentId).addClass('active');
    });

    var tags = window.tags = new Bloodhound({
        datumTokenizer: function (datum) {
            return Bloodhound.tokenizers.whitespace(datum.name);
        },
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        limit: 10,
        prefetch: {
            url: window.URL_SITE + 'tags.json',
            filter: function (list) {
                console.log(list.entries);
                return list.entries;
            }
        }
    });

    $('textarea[data-editor]').each(function () {
        var textarea = $(this),
            mode = textarea.data('editor'),
            editDiv = $('<div>', {
            position: 'absolute',
            width: textarea.width(),
            height: textarea.height(),
            'class': textarea.attr('class')
        }).insertBefore(textarea);

        textarea.css('display', 'none');

        var editor = window.editor = ace.edit(editDiv[0]);
        editor.renderer.setShowGutter(true);
        editor.getSession().setValue(textarea.val());
        editor.getSession().setMode("ace/mode/" + mode);
        editor.setTheme("ace/theme/github");

        editor.on('blur', function() {
            $('#review').html(marked(editor.getSession().getValue()));
        });

        editor.focus();
        // editor.gotoLine(editor.session.getLength(), editor.session.getLine(editor.session.getLength() - 1).length);
    });

    $('body').loadie(0.5);

    tags.initialize();

    $('#test').tagsinput({
        itemValue: 'id',
        itemText: function(item) { return item.text; }
    });

    $.each(window.arr, function(key, value) {
        $('#test').tagsinput('add', {id: value.id, text: value.text}, true);
    });

    $('#test').tagsinput('input').typeahead(null, {
        highlight: true,
        displayKey: 'name',
        source: tags.ttAdapter()
    }).bind('typeahead:selected', $.proxy(function (obj, datum) {
        this.tagsinput('add', {id: datum.$id, text: datum.name}, true);
        setTimeout(function() {
            $('#test').tagsinput('input').typeahead('val', '');
        }, 1);
    }, $('#test')));

    marked.setOptions({
        highlight: function(code) {
            return hljs.highlightAuto(code).value;
        }
    });

    $('body').loadie(1);

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
})(window.$, window.ace, window.marked, window.hljs, window.Bloodhound);
