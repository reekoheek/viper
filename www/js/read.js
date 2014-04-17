(function (marked, hljs, $, _, Bloodhound, moment) {
    'use strict';

    _.templateSettings = {
        interpolate : /\{\{([\s\S]+?)\}\}/g
    };

    marked.setOptions({
        highlight: function (code) {
            return hljs.highlightAuto(code).value;
        }
    });

    $('body').loadie();

    var tags = {},
        author = {},
        template = '',
        fetchTemplate = function () {
            var deferred = $.Deferred();

            $.ajax({
                url: window.URL_BASE + 'tpl/entry.tpl'
            }).done(function (templateString) {
                template = templateString;
                deferred.resolve();
            });

            return deferred.promise();
        },
        compileTemplate = function (data, immediate) {
            var deferred = $.Deferred(),
                compiled;

            data = (immediate) ? data : data.entry;

            $('body').loadie(0.7);

            compiled           = _.template(template);
            data.author        = _.first(_.where(author, {'$id': data.$created_by}));
            data.tag           = _.first(_.where(tags, {'$id': data.tags}));
            data.$created_time = moment(data.$created_time).format('llll');
            data.entry         = marked(data.content);
            data.URL_BASE      = window.URL_BASE;
            data.URL_SITE      = window.URL_SITE;
            data.url           = window.location.href;

            $('.container.post').append(compiled(data));

            deferred.resolve();

            return deferred.promise();
        },
        renderTemplate = function (data, immediate) {
            var deferred = $.Deferred(),
                compiled,
                promise;

            $('body').loadie(0.3);

            if (template === '') {
                promise = fetchTemplate();
                promise.done(function () {
                    compileTemplate(data, immediate).done(function() {
                        deferred.resolve();
                    });
                });
            } else {
                compileTemplate(data, immediate).done(function() {
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
                url: window.URL_BASE + 'entries.json',
                filter: function(list) {
                    return list.entries;
                }
            }
        });

    entries.initialize().done(function () {
        $('.typeahead').typeahead(null, {
            highlight: true,
            name: '',
            displayKey: 'title',
            source: entries.ttAdapter()
        }).on('typeahead:selected', function (event, datum) {
            location.href = window.URL_SITE + 'entries/' + datum.$id;
        });
    });

    $.ajax({
        url: window.URL_SITE + 'tags.json'
    }).done(function (data) {
        tags = data.entries;

        $('body').loadie(0.2);

        $.ajax({
            url: window.URL_SITE + 'author.json'
        }).done(function (response) {
            $('body').loadie(0.4);

            author = response.entries;

            $.ajax({
                url: window.URL_SITE + 'entries/' + _.last(window.location.pathname.split('/')) + '.json'
            }).done(function (data) {
                $('body').loadie(0.7);

                renderTemplate(data).done(function () {
                    $('body').loadie(1);
                });
            });
        });

    });
})(window.marked, window.hljs, window.$, window._, window.Bloodhound, window.moment);
