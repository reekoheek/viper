(function (marked, $, _, Bloodhound, moment) {
    'use strict';

    $('body').loadie();

    // The variables
    var tags = {},
        author = {},
        template = '',
        fetchTemplate = function () {
            var deferred = $.Deferred();

            $.ajax({
                url: window.URL_BASE + 'tpl/entries.tpl'
            }).done(function (templateString) {
                template = templateString;
                deferred.resolve();
            });

            return deferred.promise();
        },
        compileTemplate = function (data, immedieate) {
            var deferred = $.Deferred(),
                compiled,
                preview;

            data = (immedieate) ? data : data.entries;

            $('body').loadie(0.7);

            $.each(data, function (key, model) {
                model.tag = [];

                $.each(model.tags, function(key, value) {
                    model.tag.push(_.first(_.where(tags, {'$id': value})).name);
                });

                compiled            = _.template(template);
                model.author        = _.first(_.where(author, {'$id': model.$created_by}));
                model.$created_time = moment(model.$created_time).format('llll');
                preview             = $(marked($.parseHTML(model.content)[0].data)).filter(function () {
                    return !!$.trim(this.innerHTML || this.data);
                });
                model.preview       = $('<div>').append(preview[0]).append(preview[1]).html();
                model.url           = window.location.href;

                data.URL_BASE       = window.URL_BASE;
                data.URL_SITE       = window.URL_SITE;

                $('.container.posts').append(compiled(model));
            });

            deferred.resolve();

            return deferred.promise();
        },
        renderTemplate = function (data, immedieate) {
            var deferred = $.Deferred(),
                compiled,
                preview,
                promise;

            $('body').loadie(0.3);

            if (template === '') {
                promise = fetchTemplate();
                promise.done(function () {
                    compileTemplate(data, immedieate).done(function () {
                        deferred.resolve();
                    });
                });
            } else {
                compileTemplate(data, immedieate).done(function () {
                    deferred.resolve();
                });
            }

            return deferred.promise();
        },
        entries = window.entries = new Bloodhound({
            datumTokenizer: function (datum) {
                return Bloodhound.tokenizers.whitespace(datum.content);
            },
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            limit: 10,
            prefetch: {
                url: window.URL_SITE + 'entries.json?!sort[_created_time]=-1',
                filter: function (list) {
                    return list.entries;
                }
            }
        }),
        renderMatch = function () {
            entries.get($('.typeahead.tt-input').val(), function (suggestions) {
                if (suggestions.length === 0) {
                    window.alert('Why you search something doesn\'t exist?');
                } else {
                    $('.container.posts').html('');
                    renderTemplate(suggestions, true).done(function () {
                        $('body').loadie(1);
                    });
                }
            });
        },
        initialize = function () {
            entries.initialize();

            $('.typeahead').typeahead(null, {
                highlight: true,
                name: '',
                displayKey: 'title',
                source: entries.ttAdapter()
            }).on('typeahead:selected', function (event, datum) {
                location.href = window.URL_SITE + 'entries/' + datum.$id;
            }).on('keypress', function (event) {
                if (event.which === 13) {
                    $('body').loadie();
                    renderMatch();
                }
            });

            $('.search').click(function () {
                $('body').loadie();
                renderMatch();
            });
        };
    // End of variables

    $.ajax({
        url: window.URL_SITE  + 'tags.json'
    }).done(function (data) {
        tags = data.entries;

        $('body').loadie(0.2);

        $.ajax({
            url: window.URL_SITE + 'author.json'
        }).done(function (response) {
            $('body').loadie(0.4);

            author = response.entries;

            $.ajax({
                url: window.URL_SITE + 'entries.json?!sort[_created_time]=-1'
            }).done(function (data) {
                $('body').loadie(0.6);

                if (data.entries.length) {
                    renderTemplate(data).done(function () {
                        $('body').loadie(0.8);
                        initialize();
                    });
                } else {
                    $.ajax({
                        url: window.URL_BASE + 'tpl/empty.tpl'
                    }).done(function (templateString) {
                        $('.container.posts').append(templateString);
                        $('body').loadie(0.8);
                    });
                }

                $('body').loadie(1);
            });
        });
    });
})(window.marked, window.$, window._, window.Bloodhound, window.moment);
