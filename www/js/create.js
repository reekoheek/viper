(function ($, ace, marked, hljs, Bloodhound) {
    'use strict';

    $('body').loadie();

    var editor = ace.edit($('.le-editor')[0]),
        tags = window.tags = new Bloodhound({
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

    editor.setTheme('ace/theme/github');
    editor.session.setMode('ace/mode/markdown');

    $('[name=title]').focus();

    $('body').loadie(0.5);
    $('#test').tagsinput({
        itemValue: 'id',
        itemText: function(item) {
            return item.text;
        }
    });

    tags.initialize();

    $('#test').tagsinput('input').typeahead(null, {
        highlight: true,
        name: '',
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

    editor.on('change', function(event) {
        $('.twitter-typeahead pre[aria-hidden=true]').css('margin-bottom', '-50px');
    });

    $(document).on('click', '.show-preview', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $('.le-action').css('position', 'relative');

        $(event.target).text('Close Preview');
        $(event.target).attr('class', 'close-preview');

        $('.le-preview').html(marked(editor.getValue()));

        $('.le-editor').hide();
        $('.le-preview').show();
    });

    $(document).on('click', '.close-preview', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $('.le-action').css('position', 'absolute');

        $(event.target).text('Preview');
        $(event.target).attr('class', 'show-preview');

        $('.le-preview').html('');

        $('.le-editor').show();
        $('.le-preview').hide();
    });

    $('.le-action .save').on('click', function (event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        // $('body').loadie();

        $('[name=content]').val(editor.getValue());
        $('form').submit();

        // var data = $('form').serialize();

        // $.ajax({
        //     url: location.href + '.json',
        //     data: data,
        //     type: 'POST'
        // }).done(function (response, textStatus, jqXHR) {
        //     $('body').loadie(1);
        //     $('.alert').attr('class', 'alert success');
        //     $('body .le-content div .alert span').text('Success updating!');
        //     $('body .le-content div .alert').fadeIn();

        //     var loc = location.href.split('/');
        //     location.href = loc.splice(0, loc.length - 2).join('/');
        // }).fail(function (response, textStatus, jqXHR) {
        //     $('body').loadie(1);
        //     $('.alert').attr('class', 'alert error');
        //     $('body .le-content div .alert span').text('Error updating!');
        //     $('body .le-content div .alert').fadeIn();
        //     window.console.error(response, textStatus, jqXHR);
        // });
    });

    $('body').loadie(1);
})(window.$, window.ace, window.marked, window.hljs, window.Bloodhound);
