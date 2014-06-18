<div class="row">
    <div class="meta span-4">
        <div>
            <img src="{{ URL_BASE + '/img/' + author.twitter + '.jpeg' }}" style="width:80px; height:80px ">
        </div>
        <div class="clearfix"></div>
        <ul>
            <li><h3><a href="{{ URL_SITE }}entries/{{ $id }}"> {{ title }} </a></h3></li>
            <li>
                <a href="mailto:{{ author.email }}">
                    {{ author.email }}
                </a>
            </li>
            <li>
                <a href="https://twitter.com/{{ author.twitter }}">
                    <span class="fa fa-twitter"></span> @{{ author.twitter }}
                </a>
            </li>
            <li>{{ $created_time }}</li>
            <li>
                Tagged in:
                {{# _.each(tag, function(key, value) { }}
                    <a href="#">#{{ key }}</a>
                {{# }); }}
            </li>
            <li></li>
        </ul>
    </div>

    <article class="post span-8">
        <h1><a href="{{ URL_SITE }}entries/{{ $id }}"> {{ title }} </a></h1>
        <hr />
        {{ preview }}
        <hr />
        <div class="action">
            <a class="button twitter"
                href="https://twitter.com/share?url={{url}}&text={{title}}&via={{author.twitter}}&hashtags={{tag.name}}">
                <i class="fa fa-twitter"></i> Share on Twitter
            </a>
            <a class="button" href="{{ URL_SITE }}entries/{{ $id }}"><i class="fa fa-pagelines"></i> Read More</a>
        </div>
    </article>

    <div class="blank span-2"></div>
</div>
