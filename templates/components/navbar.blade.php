<header id="header" class="header header--fixed hide-from-print">
    <ul class="button-group centered">
        <li class=""><a href="{{ URL::base() }}" class="button"><i class="fa fa-home"></i> Home</a></li>
        @if($app->auth->check())
            <li><a href="{{ URL::site('author') }}" class="button"><i class="fa fa-lock"></i> Author</a></li>
            <li><a href="{{ URL::site('tags') }}" class="button"><i class="fa fa-tags"></i> Tags</a></li>
            <li><a href="{{ URL::site('entries') }}" class="button"><i class="fa fa-heart"></i> Entries</a></li>
            <li><a href="{{ URL::site('logout') }}" class="button"><i class="fa fa-sign-out"></i> Logout</a></li>
        @else
            <li><a href="{{ URL::site('login') }}" class="button"><i class="fa fa-sign-in"></i> Login</a></li>
        @endif
        <li><a href="{{ URL::site('about') }}" class="button"><i class="fa fa-user"></i> About</a></li>
    </ul>
</header>
