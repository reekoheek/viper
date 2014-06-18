@section('content')
<?php use Bono\Helper\URL; ?>

<div class="container" style="margin-bottom: 20px">
    <div class="row">
        <img src="{{ URL::base('/img/viper.png') }}" alt="" class="logo" style="">
    </div>
    <h1 class="text-center">VIPER <small>eVerything Is PERmitted</small></h1>
    <h2 class="text-center">Made by <i class="fa fa-heart"></i> and PHP</h2>
</div>

<hr />

<div class="container" style="">
    <p class="text-center">
        A new way to writing, inspired from Subhan Toba. So people now can write
        what is in their mind via a fun and fast blogging-like system.
        <br />
        If you want to contribute to this project, you can follow this project via <a taget="_blank" href="https://github.com/krisanalfa/viper">GitHub</a>.
        Fork it, create a new branch, do some magic, and create a pull request. Viper using <a href="http://www.php-fig.org/psr/psr-2/">PSR-2 coding standard</a>.
        If you find some errors or maybe you wish there's a feature inside Viper and you but cannot write a code, you can follow the milestone via GitHub too.
        Go to <a href="https://github.com/krisanalfa/viper/issues">issue page</a>, and create a <a href="https://github.com/krisanalfa/viper/issues/new">new issue</a> there.
        <br /><br />
        <small>The Viper image and favicon is a trademark from Valve (DotA 2)</small>
    </p>
</div>

<hr />

<div class="container" style="">
    <h2 class="text-center"><small>Creative by Krisan Alfa Timur</small></h2>
    <div class="text-center">
        <a taget="_blank" href="https://github.com/krisanalfa"><i class="fa fa-github fa-2x"></i></a>
        <a taget="_blank" href="https://twitter.com/krisanalfa"><i class="fa fa-twitter fa-2x"></i></a>
        <a taget="_blank" href="https://facebook.com/KrisanAlfa.T"><i class="fa fa-facebook fa-2x"></i></a>
    </div>
    <h4 class="text-center"><small>PT. Sagara Xinix Solusitama</small></h4>
</div>
@endsection
